<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Via\Common\Service;

use GuzzleHttp\Command\ServiceClientInterface;
use Via\Common\Command\CommandInterface;

/**
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
interface ServiceInterface #extends ServiceClientInterface
{

    /**
     * Retrieves the name of this service as it should appear in the service catalog.
     *
     * @return string|null
     */
    public function getName();

    /**
     * Retrieves the type of this service as it should appear in the service catalog.
     *
     * @return string|null
     */
    public function getType();

    /**
     * Retrieve the description for this service.
     *
     * @return \GuzzleHttp\Command\Guzzle\Description
     */
    public function getDescription();

    /**
     * Magic method that retrieves a command by its name (via {@see getCommand()})
     * and then automatically executes it for the user. This makes the whole
     * process a bit more efficient.
     *
     * @param string $name The command name
     * @param array $arguments The arguments to pass in to the command
     *
     * @return mixed Returns the result of the command
     */
    public function __call($name, array $arguments);

    /**
     * Retrieve a command by its name
     *
     * @param string $name The name of the command you wish to instantiate
     * @param array $args Optional arguments that are passed to the command object as it is instantiated
     *
     * @return \Via\Common\Command\CommandInterface
     *
     * @throws \InvalidArgumentException If no command can be found by that name
     */
    public function getCommand($name, array $args = []);

    /**
     * Retrieve an iterator by its name
     *
     * @param string $name Name of the command
     * @param array $args An optional array of configuration values to pass in
     * to the iterator
     *
     * @return \Via\Common\Iterator\ResourceIterator
     */
    public function getIterator($name, array $args = []);

    /**
     * Executes a command by marshalling it into a {@see GuzzleHttp\Message\RequestInterface},
     * sending the request and parsing the response into a suitable model.
     *
     * @param CommandInterface $command The command to execute
     *
     * @return \GuzzleHttp\Message\ResponseInterface|\Via\Common\Command\ModelInterface
     *
     * @throws \Via\Common\Command\CommandException If any exception was raised during the life cycle
     * of a request's execution, then it is wrapped in a
     * generic CommandException to preserve consistency.
     */
    public function execute(CommandInterface $command);

    /**
     * Executes multiple commands in parallel.
     *
     * @param array $commands An array of {@see CommandInterface} objects that need to be batched and sent. They are
     * first serialized into {@see GuzzleHttp\Message|RequestInterface} objects by the
     * {@see CommandToRequestIterator} iterator. All this does is iterate over the array, and
     * convert each one. This is then passed to the parent {@see ClientInterface} object which
     * executes each one using the cURL multi-handle API.
     * @param array $options An optional array of configuration values, such as the amount of parallel handles to use
     *
     * @return array An array is returned containing these three elements:
     * - errors (flat array) denotes all the requests that failed. Each value represents the path of the
     * request URL that was sent to the API
     * - successes (flat array) denotes all the requests that failed. Each value represents the path of the
     * request URL that was sent to the API
     * - responses (associative array) denotes every response that was received. Every element key's
     * request URL path, and every value is a {@see GuzzleHttp\Message\ResponseInterface} object
     *
     * An example might be:
     *
     * <code>
     * [
     * "errors" => ["/resource_1"],
     * "successes" => ["/resource_2", "resource_3"],
     * "responses" => [
     * "resource_1" => class Response {},
     * "resource_2" => class Response {},
     * "resource_3" => class Response {}
     * ]
     * ]
     * </code>
     */
    public function executeAll($commands, array $options = []);

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient();
}
