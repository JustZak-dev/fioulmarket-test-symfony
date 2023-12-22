<?php

namespace App\Service\FeedManager\Utils;

use App\Service\FeedManager\Interfaces\ParserInterface;
use App\Service\FeedManager\Interfaces\ParserManagerInterface;
use App\Service\FeedManager\Parser\JSONParser;
use App\Service\FeedManager\Parser\XMLParser;

class ParserManager implements ParserManagerInterface
{
    public function handle($parser, string $content)
    {
        return $this->filterFormat(new $parser($content)) ?? null;
    }

    private function filterFormat($parseInstance)
    {
        if ($parseInstance->canBeParsed()) {
            return $parseInstance;
        }

        return false;
    }
}