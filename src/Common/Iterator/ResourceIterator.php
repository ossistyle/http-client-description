<?php

namespace OpenStack\Common\Iterator;

use Iterator;
use Countable;
use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Command\ServiceClientInterface;
use OpenStack\Common\Command\CommandInterface;
use OpenStack\Common\Model\Model;
use OpenStack\Common\Service\ResponseLocation\JsonLocation;
use OpenStack\Common\Service\ServiceInterface;

/**
 * Standard iterator used to represent a collection of remote resources. This
 * iterator supports paginated collections by default, and will execute requests
 * in order to append new elements when the current selection is exhausted.
 *
 * @package OpenStack\Common\Iterator
 */
class ResourceIterator implements Iterator, Countable
{
    const MAX_PAGE_SIZE = 10000;

    /** @var int */
    private $position;

    /** @var array */
    private $elements = [];

    /** @var \GuzzleHttp\Message\ResponseInterface */
    private $lastResponse;

    /** @var array */
    private $lastResponseCollection;

    /** @var bool */
    private $cancelIteration = false;

    /** @var mixed */
    private $marker;

    /** @var CommandInterface */
    private $command;

    /** @var ServiceInterface */
    private $httpClient;

    /** @var array */
    private $options;

    /**
     * @param ServiceInterface $httpClient The client responsible for managing network transactions
     * @param CommandInterface $command    The command responsible for retrieving the resources from the API
     * @param array            $options    User-defined configuration options that are used to define behaviour
     *                                     for certain aspects of this iterator. These include:
     *
     *                                     - pageSize (int) denotes how many resources are to be grouped per page
     *
     *                                     - totalSize (int) denotes how many resources in total are to be
     *                                       returned by this iterator
     *
     *                                     - modelSchema (array) is an array which indicates how each array
     *                                       resource should populate a {@see OpenStack\Common\Model\ModelInterface}
     *
     *                                     - elementKey (string) denotes the JSON key under which all elements
     *                                       are nested in the API response body
     *
     *                                     - markerKey (string) denotes what property of the array/model to use
     *                                       as the marker for the next URL
     */
    public function __construct(
        ServiceInterface $httpClient,
        CommandInterface $command,
        array $options = []
    ) {
        $this->httpClient = $httpClient;
        $this->command = $command;

        $this->validateOptions($options);

        $this->rewind();
    }

    /**
     * @param array $options Same as defined in {@see __construct()}
     */
    private function validateOptions(array $options)
    {
        if (!isset($options['pageSize'])) {
            $options['pageSize'] = self::MAX_PAGE_SIZE;
        }

        if (!isset($options['totalSize'])) {
            $options['totalSize'] = false;
        }

        $this->options = $options;
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Move the internal marker to new point, analogous to `fseek'
     *
     * @param int $num
     */
    public function seek($num)
    {
        $this->position = (int) $num;
    }

    /**
     * @return mixed|Model
     */
    public function current()
    {
        $element = $this->elements[$this->position];

        if (isset($this->options['modelSchema'])) {
            $model = new Model();
            $location = new JsonLocation($element);
            $location->visitData(new Parameter($this->options['modelSchema']), $model);
            return $model;
        }

        return $element;
    }

    /**
     * @return int|mixed
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        if (isset($this->elements[$this->position])) {
            return true;
        } elseif (true === $this->shouldSendNewRequest()) {
            $this->sendRequest();
            return $this->valid();
        } else {
            return false;
        }
    }

    /**
     * A new request needs to be sent to the server if the previous response
     * contains >= elements than in set by the limit. For example, if the limit
     * is 100; and the previous response contains 79, we know that there are no
     * more resources. If the previous response contains 100 elements, we know
     * there are more outside the bounds of the last request.
     *
     * @return bool
     */
    private function shouldSendNewRequest()
    {
        if ($this->cancelIteration === true) {
            return false;
        }

        $currentCount = count($this->elements);

        // The most precedence should be given to situations where we have empty
        // list - i.e. at the beginning of this iterator's traversal
        if (!$currentCount) {
            return true;
        }

        if (
            // If the user doesn't limit the collection size - carry on. Otherwise,
            // do we currently have fewer resources than the total asked of us?
            ($this->options['totalSize'] === false || $currentCount < $this->options['totalSize'])

            // If so, has the last response indicated there are more resources left?
            && count($this->lastResponseCollection) == $this->options['pageSize']

            // If so, do we have a marker to use for the next request?
            && $this->marker !== null
        ) {
            return true;
        }

        return false;
    }

    /**
     * Sends a request to the API.
     */
    private function sendRequest()
    {
        $this->lastResponse = $this->httpClient->execute($this->command);

        $body = $this->lastResponse->json();

        if (!$body || $this->lastResponse->getStatusCode() == 204) {
            $this->cancelIteration = true;
            return;
        }

        // Parse decoded JSON array
        $this->lastResponseCollection = $this->extractCollectionFromArray($body);

        // Update marker for next request
        $this->updateMarker();

        // Merge new collection with existing
        $this->elements = array_merge($this->elements, $this->lastResponseCollection);
    }

    /**
     * @throws \RuntimeException If no marker value can be retrieved from collection
     */
    private function updateMarker()
    {
        // Update marker to last element of returned collection
        end($this->lastResponseCollection);
        $lastElement = current($this->lastResponseCollection);

        $markerKey = isset($this->options['markerKey']) ? $this->options['markerKey'] : 'name';

        if (!isset($lastElement[$markerKey])) {
            throw new \RuntimeException(sprintf(
                "The marker key \"%s\" could not be found inside the last element of the collection",
                $markerKey
            ));
        }

        $this->marker = $lastElement[$markerKey];
    }

    /**
     * @param array $body An array of data decoded from JSON response
     *
     * @return array
     * @throws \RuntimeException If elements cannot be extracted from a nested
     *                           structure; either because the array key is not
     *                           known, does not exist, or the structure itself
     *                           is not an array
     */
    private function extractCollectionFromArray(array $body)
    {
        $elements = $body;

        // If an elementKey option is set, treat the data like an associative array.
        // Otherwise, treat it as a flat array.
        if (isset($this->options['elementKey'])) {
            $key = $this->options['elementKey'];
            if (!isset($body[$key])) {
                throw new \RuntimeException(
                    sprintf("The response body does not contain a \"%s\" key", $key)
                );
            }
            $elements = $body[$key];
        }

        if (!is_array($elements)) {
            throw new \RuntimeException(
                'The structure which contains the resources is not an array'
            );
        }

        return $elements;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * Casts the iterator to an array, invoking an optional callback if supplied
     *
     * @param callable $fn An anonymous function or callback that will be invoked in every iteration of the loop.
     *                     Useful for filtering or extracting data from the model as it is returned from
     *                     {@see current()}. The function will need to accept 1 argument that can be accessed as an array.
     *
     * @return array       All of the elements this iterator can handle
     */
    public function toArray(callable $fn = null)
    {
        $elements = [];

        while ($this->valid()) {
            $model = $this->current();
            $elements[] = ($fn) ? call_user_func($fn, $model) : $model;
            $this->next();
        }

        return $elements;
    }
}
