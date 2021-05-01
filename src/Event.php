<?php

declare(strict_types=1);

namespace Carry;

use DateTimeInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class Event
 * @package Carry
 */
class Event implements EventInterface
{
    /**
     * @var string
     */
    private string $type;

    /**
     * @var iterable|null
     */
    private ?iterable $data;

    /**
     * @var string
     */
    private string $id;

    /**
     * @var string|null
     */
    private ?string $source;

    /**
     * @var string|null
     */
    private ?string $dataContentType;

    /**
     * @var string|null
     */
    private ?string $dataSchema;

    /**
     * @var string|null
     */
    private ?string $subject;

    /**
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $time;

    /**
     * Event constructor.
     * @param string $type
     * @param iterable|null $data
     * @param string|null $id
     * @param string|null $source
     * @param string|null $dataContentType
     * @param string|null $dataSchema
     * @param string|null $subject
     * @param DateTimeInterface|null $time
     */
    public function __construct(
        string $type,
        ?iterable $data,
        ?string $id = null,
        ?string $source = null,
        ?string $dataContentType = null,
        ?string $dataSchema = null,
        ?string $subject = null,
        ?DateTimeInterface $time = null
    )
    {
        $this->type = $type;
        $this->data = $data;
        $this->id = $id ?? (string)Uuid::uuid4();
        $this->source = $source;
        $this->dataContentType = $dataContentType;
        $this->dataSchema = $dataSchema;
        $this->subject = $subject;
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getSpecVersion(): string
    {
        return static::CLOUD_EVENT_SPEC_VERSION;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Event
     */
    public function setType(string $type): Event
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return iterable|null
     */
    public function getData(): ?iterable
    {
        return $this->data;
    }

    /**
     * @param iterable|null $data
     * @return Event
     */
    public function setData(?iterable $data): Event
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Event
     */
    public function setId(string $id): Event
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param string|null $source
     * @return Event
     */
    public function setSource(?string $source): Event
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDataContentType(): ?string
    {
        return $this->dataContentType;
    }

    /**
     * @param string|null $dataContentType
     * @return Event
     */
    public function setDataContentType(?string $dataContentType): Event
    {
        $this->dataContentType = $dataContentType;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDataSchema(): ?string
    {
        return $this->dataSchema;
    }

    /**
     * @param string|null $dataSchema
     * @return Event
     */
    public function setDataSchema(?string $dataSchema): Event
    {
        $this->dataSchema = $dataSchema;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     * @return Event
     */
    public function setSubject(?string $subject): Event
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getTime(): ?DateTimeInterface
    {
        return $this->time;
    }

    /**
     * @param DateTimeInterface|null $time
     * @return Event
     */
    public function setTime(?DateTimeInterface $time): Event
    {
        $this->time = $time;

        return $this;
    }
}
