<?php

namespace App\Service\FeedManager\Parser;

use App\Service\FeedManager\Parser\Abstracts\ParserAbstract;

class JSONParser extends ParserAbstract
{
    protected ?string $id = 'json-parser';

    public function canBeParsed(): bool
    {
        $result = false;

        try {
            $jsonCheck = json_decode($this->content);

            if ($jsonCheck !== null) {
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

        return json_decode($this->content, $toArray);
    }
}