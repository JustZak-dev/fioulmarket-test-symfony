<?php

namespace App\Service\FeedManager\Utils;

use App\Service\FeedManager\Interfaces\FeedClientInterface;
use App\Service\FeedManager\Interfaces\FeedProcessorInterface;
use App\Service\FeedManager\Interfaces\ParserManagerInterface;

class FeedProcessor implements FeedProcessorInterface
{
    private FeedClientInterface $client;
    private ParserManagerInterface $parserManager;

    public function __construct(FeedClientInterface $client, ParserManagerInterface $parserManager)
    {
        $this->client = $client;
        $this->parserManager = $parserManager;
    }

    public function handleStream(string $apiUrl)
    {
        try {
            $response = $this->client->retrieve($apiUrl);

            return $this->parserManager->handle($response);
        } catch (\Throwable $exception) {
            throw new \Exception("handleStream is not working, {$exception->getMessage()}");
        }
    }

    private function format(string $content)
    {

    }

    private function xmlParser(string $content)
    {

    }

    private function jsonParser(string $content)
    {

    }
}