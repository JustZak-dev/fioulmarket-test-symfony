<?php

namespace App\Service\FeedManager\Utils;

use App\Service\FeedManager\Interfaces\ParserInterface;
use App\Service\FeedManager\Interfaces\ParserManagerInterface;
use App\Service\FeedManager\Parser\JSONParser;
use App\Service\FeedManager\Parser\XMLParser;

class ParserManager implements ParserManagerInterface
{
    private $parserFormats = [
        XMLParser::class
    ];

    public function handle(string $content, bool $autoCheck = true, $format = XMLParser::class)
    {
        if (!$autoCheck) {
            return $this->filterFormat(new $format($content)) ?? null;
        }

        return $this->autoCheck($content);
    }

    private function autoCheck(string $content)
    {
        $instance = null;

        foreach ($this->parserFormats as $parserFormat) {
            if (!$parseInstance = $this->filterFormat(new $parserFormat($content))) {
                continue;
            }

            $instance = $parseInstance;
        }

        return $instance;
    }

    private function filterFormat($parseInstance)
    {
        if ($parseInstance->canBeParsed()) {
            return $parseInstance;
        }

        return false;
    }

    public function getParserFormats(): array
    {
        return $this->parserFormats;
    }

    public function addParserFormats(string $parserFormats): self
    {
        $this->parserFormats[] = $parserFormats;

        return $this;
    }
}