<?php

namespace App\Controller;

use App\Service\FeedManager\FeedManagerService;
use App\Service\FeedManager\Interfaces\ParserInterface;
use App\Service\FeedManager\Interfaces\ParserManagerInterface;
use App\Service\FeedManager\Parser\JSONParser;
use App\Service\FeedManager\Parser\XMLParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private FeedManagerService $feedManagerService;
    private ParserManagerInterface $parserManager;

    public function __construct(
        FeedManagerService     $feedManagerService,
        ParserManagerInterface $parserManager
    )
    {
        $this->feedManagerService = $feedManagerService;
        $this->parserManager = $parserManager;
    }

    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        $this->parserManager
            ->addParserFormats(JSONParser::class);

        $createFeedsApis = $this->feedManagerService->create([
            'http://www.commitstrip.com/en/feed/',
            'https://newsapi.org/v2/top-headlines?country=us&apiKey=c782db1cd730403f88a544b75dc2d7a0'
        ]);

        /** @var ParserInterface $createFeedsApi */
        foreach ($createFeedsApis as $createFeedsApi) {
            dd($createFeedsApi->parse()->channel->item[0]->children("content", true));
        }

        return new Response('fzef');
    }
}
