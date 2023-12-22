<?php

namespace App\Controller;

use App\Service\FeedManager\ApiParser\CommitStripParser;
use App\Service\FeedManager\ApiParser\NewsApiParser;
use App\Service\FeedManager\FeedManagerService;
use App\Service\FeedManager\Interfaces\ParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private FeedManagerService $feedManagerService;

    public function __construct(
        FeedManagerService $feedManagerService,
    )
    {
        $this->feedManagerService = $feedManagerService;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        /**
         * Ici, j'ai répondu au besoin de pouvoir ajouter de nouveaux flux.
         *
         * Le système est très basique et simple à comprendre.
         *
         * Il faut créer une class Parser portant le nom de l'api (convention) et la relier à l'url de l'API.
         * Toute la gestion du flux se fait dans les class Parser.
         *
         * Bien sûr le système peut être amélioré pour intégrer les apiUrl directement dans les class Parser.
         * Mais j'ai décidé de laisser les apiUrl ici afin de mieux illustrer la lisibilité.
         */
        $createFeedsApis = $this->feedManagerService->create([
            CommitStripParser::class => 'http://www.commitstrip.com/en/feed/',
            NewsApiParser::class => 'https://newsapi.org/v2/top-headlines?country=us&apiKey=c782db1cd730403f88a544b75dc2d7a0'
        ]);

        $images = [];

        /** @var ParserInterface $createFeedsApi */
        foreach ($createFeedsApis as $createFeedsApi) {
            $images[] = $createFeedsApi->parse();
        }

        $combinedImages = array_unique(array_merge(...$images));

        return $this->render('default/index.html.twig', ['images' => $combinedImages]);
    }
}
