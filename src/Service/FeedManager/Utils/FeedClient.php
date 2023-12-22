<?php

namespace App\Service\FeedManager\Utils;

use App\Service\FeedManager\Interfaces\FeedClientInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FeedClient implements FeedClientInterface
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function retrieve(string $url): string
    {
        $response = $this->client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new \HttpException("{$url} is not available.");
        }

        return $response->getContent();
    }
}