<?php

namespace App\Service\FeedManager\Helpers;

class ScraperImg
{
    protected array $imgExtensions = [
        'jpg',
        'png',
        'jpeg',
        'gif'
    ];

    public function getContentImgSources(string $content)
    {
        $pattern = "/\bhttps?:\/\/\S+\.(?:{$this->getExtensionsMapped()})\b/";

        preg_match_all($pattern, $content, $imagesUrlsMatches);

        $link = array_unique($imagesUrlsMatches[0]);

        return count($link) === 1 ? $link[0] : $link;
    }

    private function getExtensionsMapped(): string
    {
        if (!count($this->imgExtensions)) {
            throw new \Exception('You need to add images extensions');
        }

        return implode('|', $this->imgExtensions);
    }

    public function setImgExtensions(array $imgExtensions): void
    {
        $this->imgExtensions = $imgExtensions;
    }
}