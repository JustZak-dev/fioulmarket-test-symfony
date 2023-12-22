<?php

namespace App\Service\FeedManager;

use App\Service\FeedManager\Interfaces\FeedClientInterface;
use App\Service\FeedManager\Interfaces\FeedProcessorInterface;

class FeedManagerService
{
    private FeedProcessorInterface $processor;

    public function __construct(FeedProcessorInterface $processor)
    {
        $this->processor = $processor;
    }

    public function create(array $apiUrls)
    {
        $treatments = [];

        foreach ($apiUrls as $apiUrl) {
            $treatments[] = $this->processor->handleStream($apiUrl);
        }

        return $treatments;
    }
}