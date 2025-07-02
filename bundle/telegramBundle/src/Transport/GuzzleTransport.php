<?php

declare(strict_types=1);

namespace Syrniki\Telegram\Transport;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\RequestOptions;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\NullLogger;
use Syrniki\Telegram\Exception\TelegramTransportException;

final class GuzzleTransport
{
    use LoggerAwareTrait;

    /**
     * @var string
     */
    private $gatewayUrl;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var CurlHandler|MockHandler
     */
    private $handler;

    /**
     * @var Client
     */
    private $client;

    public function __construct(string $gatewayUrl, string $apiKey, $handler = null)
    {
        $this->gatewayUrl = $gatewayUrl;
        $this->apiKey = $apiKey;
        $this->handler = $handler;

        $this->client = new Client([
            'handler' => $this->handler,
            RequestOptions::TIMEOUT => 5,
            RequestOptions::CONNECT_TIMEOUT => 5,
        ]);

        $this->setLogger(new NullLogger());
    }

    public function requestPost(string $method, array $data = [], $requestOptions = RequestOptions::JSON): array
    {
        $requestUrl = $this->gatewayUrl.$this->apiKey.'/'.$method;

        $this->logger->debug(sprintf('Requesting method: %s data: %s.', $method, http_build_query($data)));

        try {
            $response = $this->client->request('POST', $requestUrl, [
                $requestOptions => $data,
            ]);
        } catch (\Throwable $e) {
            throw new TelegramTransportException(sprintf('Request failed to %s: %s.', $method, $e->getMessage()), $e->getCode(), $e);
        }

        $contents = $response->getBody()->getContents();

        $this->logger->debug(sprintf('Response from %s received.', $method),
            ['response' => $contents]
        );

        try {
            $json = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new TelegramTransportException(sprintf('Response is not json: %s. Request to %s.', $contents, $requestUrl), $e->getCode(), $e);
        }

        if (!is_array($json)) {
            throw new TelegramTransportException(sprintf('Response is not array: %s. Request to %s.', $contents, $requestUrl), 400);
        }

        return $json;
    }
}
