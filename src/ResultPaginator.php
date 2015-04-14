<?php

namespace Vws;

use GuzzleHttp\Event\ListenerAttacherTrait;
use transducers as t;

/**
 * Iterator that yields each page of results of a pageable operation.
 */
class ResultPaginator implements \Iterator
{
    use ListenerAttacherTrait;

    /** @var VwsClientInterface Client performing operations. */
    private $client;

    /** @var string Name of the operation being paginated. */
    private $operation;

    /** @var array Args for the operation. */
    private $args;

    /** @var array Configuration for the paginator. */
    private $config;

    /** @var Result Most recent result from the client. */
    private $result;

    /** @var integer Next page to use for pagination. */
    private $nextPage;

    /** @var integer Entries per page to use for pagination. */
    private $limit;

    /** @var boolean Identifier if to call next page. */
    private $hasMoreResults;

    /** @var int Number of operations/requests performed. */
    private $requestCount = 0;

    /** @var array Event listeners. */
    private $listeners;

    /**
     * @param VwsClientInterface $client
     * @param string             $operation
     * @param array              $args
     * @param array              $config
     */
    public function __construct(
        VwsClientInterface $client,
        $operation,
        array $args,
        array $config
    ) {
        $this->client = $client;
        $this->operation = $operation;
        $this->args = $args;
        $this->config = $config;
        $this->listeners = $this->prepareListeners(
            $config,
            ['prepared', 'process', 'error']
        );
    }

    /**
     * Returns an iterator that iterates over the values of applying a JMESPath
     * search to each result yielded by the iterator as a flat sequence.
     *
     * @param string   $expression JMESPath expression to apply to each result.
     * @param int|null $limit      Total number of items that should be returned
     *                             or null for no limit.
     *
     * @return \Iterator
     */
    public function search($expression, $limit = null)
    {
        // Apply JMESPath expression on each result, but as a flat sequence.
        $xf = t\mapcat(function (Result $result) use ($expression) {
            return (array) $result->search($expression);
        });

        // Apply a limit to the total items returned.
        if ($limit) {
            $xf = t\comp($xf, t\take($limit));
        }

        // Return items as an iterator.
        return t\to_iter($this, $xf);
    }

    /**
     * @return Result
     */
    public function current()
    {
        return $this->valid() ? $this->result : false;
    }

    public function key()
    {
        return $this->valid() ? $this->requestCount - 1 : null;
    }

    public function next()
    {
        $this->getNext();
    }

    public function valid()
    {
        return (bool) $this->result;
    }

    public function rewind()
    {
        $this->requestCount = 0;
        $this->nextPage = null;
        $this->next();
    }

    public function hasMoreResults()
    {
        return $this->hasMoreResults;
    }

    /**
     * Loads the next result by executing another command using the next token.
     */
    private function loadNextResult()
    {
        // Create the command
        $args = $this->args;
        $command = $this->client->getCommand($this->operation, $args);
        $this->attachListeners($command, $this->listeners);

        // Set the next page
        if ($this->nextPage) {
            $command['page'] = $this->nextPage;
            $command['limit'] = $this->limit;
        }

        // Get the next result
        $this->result = $this->client->execute($command);
        $this->requestCount++;
        $this->nextPage = null;

        $this->hasMoreResults = $this->result->search($this->config['more_results']);

        // If there is no more_results to check or more_results is true
        if ($this->config['more_results'] === null
            || $this->hasMoreResults) {
            // Get the next page value
            if ($key = $this->config['page']) {
                $this->nextPage = $this->result->search($key) + 1;
            }
            // Get the next page value
            if ($key = $this->config['limit']) {
                $this->limit = $this->result->search($key);
            }
        }
    }

    /**
     * Fetch the next result for the command managed by the paginator.
     *
     * @return Result|null
     */
    private function getNext()
    {
        $this->result = null;
        // Load next result if there's a next token or it's the first request.
        if (!$this->requestCount || $this->hasMoreResults) {
            $this->loadNextResult();
        }

        return $this->result;
    }
}
