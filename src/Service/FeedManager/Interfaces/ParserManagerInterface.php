<?php

namespace App\Service\FeedManager\Interfaces;

interface ParserManagerInterface
{
    public function handle(string $content, bool $autoCheck = true);

    public function getParserFormats(): array;

    public function addParserFormats(string $parserFormats): self;
}