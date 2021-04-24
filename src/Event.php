<?php

declare(strict_types=1);

namespace Carry;

/**
 * Class Event
 * @package Carry
 */
class Event implements EventInterface
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var iterable
     */
    public iterable $properties;

    /**
     * Event constructor.
     * @param string $name
     * @param array|iterable $properties
     */
    public function __construct(string $name, $properties = [])
    {
        $this->name = $name;
        $this->properties = $properties;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Event
     */
    public function setName(string $name): Event
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return iterable
     */
    public function getProperties(): iterable
    {
        return $this->properties;
    }

    /**
     * @param iterable $properties
     * @return Event
     */
    public function setProperties(iterable $properties): Event
    {
        $this->properties = $properties;

        return $this;
    }
}
