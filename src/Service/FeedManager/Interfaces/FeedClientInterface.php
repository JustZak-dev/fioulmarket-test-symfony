<?php

namespace App\Service\FeedManager\Interfaces;

interface FeedClientInterface
{
    public function retrieve(string $url): string;
}