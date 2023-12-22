<?php

namespace App\Service\FeedManager\Helpers;

class ObjectParser
{
    public function isXML($content): bool
    {
        $result = false;

        try {
            $xmlCheck = simplexml_load_string($content);

            if ($xmlCheck) {
                $result = true;
            }
        } catch (\Throwable $exception) {
        }

        return $result;
    }

    public function isJSON($content): bool
    {
        $result = false;

        try {
            $jsonCheck = json_decode($content);

            if ($jsonCheck !== null) {
                $result = true;
            }
        } catch (\Throwable $exception) {
        }

        return $result;
    }
}