<?php

namespace App\Service\FeedManager\Interfaces;

interface FeedProcessorInterface
{
    public function handleStream($parser, string $apiUrl);
}