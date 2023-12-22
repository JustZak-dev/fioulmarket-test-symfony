<?php

namespace App\Service\FeedManager\ApiParser;

use App\Service\FeedManager\ApiParser\Abstracts\ParserAbstract;
use App\Service\FeedManager\Helpers\ObjectParser;
use App\Service\FeedManager\Helpers\ScraperImg;

class CommitStripParser extends ParserAbstract
{
    protected ?string $id = 'commit-strip-parser';

    public function canBeParsed(): bool
    {
        $objectParser = new ObjectParser();

        return $objectParser->isXML($this->content);
    }

    public function parse(): ?array
    {
        if (!$this->canBeParsed()) {
            throw new \Exception('json-parser, content can not be parsed');
        }

        $xml = simplexml_load_string($this->content, 'SimpleXMLElement', LIBXML_NOCDATA);

        return $this->scrapLinksFromXML($xml);
    }

    private function scrapLinksFromXML(\SimpleXMLElement $xml): ?array
    {
        if (!$xml->count()) {
            return null;
        }

        $links = [];
        $scraperImg = new ScraperImg();

        foreach ($xml->channel->item as $item) {
            $links[] = $scraperImg->getContentImgSources($item->children('content', true));
        }

        return $links;
    }
}