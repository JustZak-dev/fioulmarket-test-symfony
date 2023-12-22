<?php

namespace App\Service\FeedManager\Parser;

use App\Service\FeedManager\Parser\Abstracts\ParserAbstract;

class XMLParser extends ParserAbstract
{
    protected ?string $id = 'xml-parser';

    public function canBeParsed(): bool
    {
        $result = false;

        try {
            $xmlCheck = simplexml_load_string($this->content);

            if ($xmlCheck) {
                $result = true;
            }
        } catch (\Throwable $exception) {
        }

        return $result;
    }

    public function parse(bool $toArray = false)
    {
        if (!$this->canBeParsed()) {
            throw new \Exception('json-parser, content can not be parsed');
        }

        return simplexml_load_string($this->content, 'SimpleXMLElement', LIBXML_NOCDATA);
    }
}