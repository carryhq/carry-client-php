<?php

declare(strict_types=1);

namespace Carry;

use InvalidArgumentException;
use Psr\EventDispatcher\EventDispatcherInterface;

/**
 * Class Client
 * @package Carry
 */
class Client implements EventDispatcherInterface
{
    /**
     * @var string
     */
    private string $endpoint;

    /**
     * Client constructor.
     * @param string $endpoint
     */
    public function __construct(string $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param object $event
     * @return object|void
     */
    public function dispatch(object $event)
    {
        if (!$event instanceof Event) {
            throw new InvalidArgumentException(sprintf(
                "Dispatched event must be an instance of '%s'; '%s' given",
                Event::class,
                get_class($event)
            ));
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, get_object_vars($event));
        curl_exec($ch);

        curl_close($ch);
    }
}
