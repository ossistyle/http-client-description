<?php

/*
 * This file is part of the VIA-eBay package.
 *
 * (c) VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Via\Common\Command;

use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Event\EmitterInterface;

/**
 * Description of ComandFactory
 *
 * @author VIA-Online GmbH | eBay Inc. <thoffmann@ebay.com>
 */
class CommandFactory
{

    /**
     * The description schema inserted into each command as its created
     *
     * @var \GuzzleHttp\Command\Guzzle\Description
     */
    private $description;

    /**
     * The emitter which each command needs in order to emit events
     *
     * @var \GuzzleHttp\Event\EmitterInterface
     */
    private $emitter;

    /**
     * @param Description $description
     * @param EmitterInterface $emitter
     */
    public function __construct(Description $description, EmitterInterface $emitter)
    {
        $this->description = $description;
        $this->emitter = clone $emitter;
    }

    /**
     * @param string $name The name of the command
     * @param array $args Configuration options injected into the command
     * @param bool $allowRetry A bool flag that allows retries if no match was found at first. If set to TRUE, then
     * the factory will uppercase the $name and try again.
     *
     * @return bool|Command FALSE if no command can be found matching that name, Command otherwise
     */
    public function create($name, array $args = [], $allowRetry = true)
    {
        if (!$this->description->hasOperation($name)) {
            // If the name is not found, 1 retry is permitted
            if ($allowRetry) {
                return $this->create(ucfirst($name), $args, false);
            }
            return false;
        }
        $operation = $this->description->getOperation($name);
        return new Command($operation, $args, ['emitter' => $this->emitter]);
    }

}
