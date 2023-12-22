<?php

namespace App\Service\FeedManager\ApiParser;

use App\Service\FeedManager\ApiParser\Abstracts\ParserAbstract;
use App\Service\FeedManager\Helpers\ObjectParser;

class NewsApiParser extends ParserAbstract
{
    protected ?string $id = 'news-api-parser';

    public function canBeParsed(): bool
    {
        $objectParser = new ObjectParser();

        return $objectParser->isJSON($this->content);
    }

    public function parse()
    {
        if (!$this->canBeParsed()) {
            throw new \Exception('json-parser, content can not be parsed');
        }

        $json = json_decode($this->content);

        return $this->scrapLinksFromJSON($json);
    }

    public function scrapLinksFromJSON($data): ?array
    {
        if (!count($data->articles)) {
            return null;
        }

        $links = [];

        foreach ($data->articles as $article) {
            if (empty($article->urlToImage)) {
                continue;
            }

            $links[] = $article->urlToImage;
        }

        return $links;
    }
}