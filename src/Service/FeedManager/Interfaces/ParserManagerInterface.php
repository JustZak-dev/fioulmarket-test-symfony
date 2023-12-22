<?php

namespace App\Service\FeedManager\Interfaces;

interface ParserManagerInterface
{
    public function handle($parser, string $content);
}