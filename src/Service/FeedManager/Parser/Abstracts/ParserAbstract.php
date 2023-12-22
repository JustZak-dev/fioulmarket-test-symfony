<?php

namespace App\Service\FeedManager\Parser\Abstracts;

use App\Service\FeedManager\Interfaces\ParserInterface;

abstract class ParserAbstract implements ParserInterface
{
    protected ?string $id = null;

    protected ?string $content = null;

    public function __construct(?string $content)
    {
        $this->content = $content;
    }

    public function getId(): string
    {
        return $this->id;
    }
}