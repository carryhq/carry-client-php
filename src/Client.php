<?php

declare(strict_types=1);

namespace Carry;

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
     * @var GuzzleHttp\Client
     */
    private GuzzleHttp\Client $httpClient;

    /**
     * Client constructor.
     * @param string $apiKey
     * @param string $collectionId
     */
    public function __construct(string $apiKey, string $collectionId)
    {
        $this->apiKey = $apiKey;
        $this->collectionId = $collectionId;
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
        $payload = get_object_vars($event);
        $payload['event'] = $event->getName();
        $payload['collectionId'] = $this->collectionId;

        unset($payload['name']);

        $this->sendRequest(new Request('POST', 'https://in.carry.events/events',
            [
                'Authorization' => sprintf('Bearer %s', $this->apiKey),
                'Content-Type' => 'application/json',
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
}
