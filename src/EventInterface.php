<?php

declare(strict_types=1);

namespace Carry;

use DateTimeInterface;

/**
 * Interface EventInterface
 * @package Carry
 */
interface EventInterface
{
    public const CLOUD_EVENT_SPEC_VERSION = '1.0';

    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string|null
     */
    public function getSource(): ?string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string|null
     */
    public function getDataContentType(): ?string;

    /**
     * @return string|null
     */
    public function getDataSchema(): ?string;

    /**
     * @return string|null
     */
    public function getSubject(): ?string;

    /**
     * @return iterable|null
     */
    public function getData(): ?iterable;

    /**
     * @return DateTimeInterface|null
     */
    public function getTime(): ?DateTimeInterface;
}
