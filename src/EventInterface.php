<?php

declare(strict_types=1);

namespace Carry;

/**
 * Interface EventInterface
 * @package Carry
 */
interface EventInterface
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return iterable|null
     */
    public function getData(): ?iterable;
}
