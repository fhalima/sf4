<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ranking", name="ranking_")
 */
class RankingController extends AbstractController
{
    /**
     * @Route("_news", name="news")
     */
    public function index()
    {

        return $this->render('ranking/news.html.twig');
        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RankingController.php',
        ]);*/
    }
}
