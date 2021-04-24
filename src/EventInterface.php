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
    public function getName(): string;

    /**
     * @return iterable
     */
    public function getProperties(): iterable;
}
