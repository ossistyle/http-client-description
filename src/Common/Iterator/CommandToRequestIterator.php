<?php

namespace OpenStack\Common\Iterator;

use ArrayIterator;
use Iterator;
use GuzzleHttp\Event\CompleteEvent;
use GuzzleHttp\Event\ListenerAttacherTrait;
use OpenStack\Common\Command\CommandManager;

/**
 * Class responsible for translating a collection of
 * {@see OpenStack\Common\Command\CommandInterface} objects into a collection of
 * {@see GuzzleHttp\Message\RequestInterface} objects. This is required when
 * batch sending a set of commands, since the parallel adapter requires some
 * kind of iterator that returns a Request on each iteration.
 *
 * @package OpenStack\Common\Iterator
 */
class CommandToRequestIterator implements Iterator
{
    use ListenerAttacherTrait;

    /**
     * @var \ArrayIterator
     */
    private $commands;
    private $currentRequest;
    private $eventListeners;

    /**
     * @param ArrayIterator $iterator Internal collection of the commands we
     *                                want to translate
     * @param array         $options  User-defined options. This typically contains
     *                                "complete" and "error" keys that refer to
     *                                the events that are fired off during a
     *                                request's life cycle
     */
    public function __construct(ArrayIterator $iterator, array $options = [])
    {
        $this->commands = $iterator;

        $this->eventListeners = $this->prepareListeners(
            $options,
            ['complete', 'error']
        );

        $this->rewind();
    }

    /**
     * @return bool
     */
    public function valid()
    {
        if (!$this->commands->valid()) {
            return false;
        } else {
            return $this->setupNewRequest();
        }
    }

    /**
     * @return bool
     */
    private function setupNewRequest()
    {
        $manager = new CommandManager($this->commands->current());

        if (!($this->currentRequest = $manager->prepareRequest())) {
            $this->commands->next();
            return $this->valid();
        }

        $this->attachListeners($this->currentRequest, $this->eventListeners);

        return true;
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return $this->commands->key();
    }

    /**
     * @return void
     */
    public function next()
    {
        $this->commands->next();
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->commands->rewind();
    }

    /**
     * @return \GuzzleHttp\Message\RequestInterface
     */
    public function current()
    {
        return $this->currentRequest;
    }
}