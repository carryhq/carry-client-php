<?php

declare(strict_types=1);

namespace Carry;

use DateTimeImmutable;
use GuzzleHttp;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package Carry
 */
class Client implements ClientInterface
{
    /**
     * @var string
     */
    private string $apiKey;

    /**
     * @var string
     */
    private string $collectionId;

    /**
     * @var string
     */
    private string $source;

    /**
     * @var GuzzleHttp\Client
     */
    private GuzzleHttp\Client $httpClient;

    /**
     * @var string
     */
    private string $eventsEndpoint = 'https://in.carry.events/events';

    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $collectionId
     * @param string $source
     */
    public function __construct(string $apiKey, string $collectionId, string $source)
    {
        $this->apiKey = $apiKey;
        $this->collectionId = $collectionId;
        $this->source = $source;
        $this->httpClient = new GuzzleHttp\Client();
    }

    /**
     * @param RequestInterface $request
     * @throws ClientExceptionInterface
     */
    public function log(RequestInterface $request): void
    {
        $this->sendRequest($request);
    }

    /**
     * @param Event $event
     * @return Event
     * @throws ClientExceptionInterface
     */
    public function dispatch(Event $event): Event
    {
        $payload = array_filter([
            'specversion' => $event->getSpecVersion(),
            'type' => $event->getType(),
            'id' => $event->getId(),
            'source' => $event->getSource() ?? $this->source,
            'data' => $event->getData(),
            'datacontenttype' => $event->getDataContentType(),
            'dataschema' => $event->getDataSchema(),
            'subject' => $event->getSubject(),
            'time' => $event->getTime() ?? new DateTimeImmutable(),
            'collectionId' => $this->collectionId,
        ]);

        $this->sendRequest(new Request('POST', $this->eventsEndpoint,
            [
                'Authorization' => sprintf('Bearer %s', $this->apiKey),
                'Content-Type' => 'application/cloudevents+json',
            ],
            json_encode($payload),
        ));

        return $event;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return $this->httpClient->sendRequest($request
            ->withAddedHeader('User-Agent', 'Carry-Client (PHP); 1.0.0')
        );
    }

    /**
     * @return string
     */
    public function getCollectionId(): string
    {
        return $this->collectionId;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }
}
