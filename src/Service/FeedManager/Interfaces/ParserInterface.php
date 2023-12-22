<?php

namespace App\Service\FeedManager\Interfaces;

interface ParserInterface
{
    public function getId(): string;
    
    public function canBeParsed(): bool;

    public function parse(bool $toArray = false);
}