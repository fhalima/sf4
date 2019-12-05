<?php

namespace App\Controller;

use App\Repository\RecordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ranking", name="ranking_")
 */
class RankingController extends AbstractController
{
    /**
     * @Route("/news", name="news")
     */
    public function index(RecordRepository $recordRepository)
    {

      //  return $this->render('ranking/news.html.twig');
        /*return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RankingController.php',
        ]);*/
        $releases = $recordRepository->getLastMonthReleases();
        return $this->render('ranking/news.html.twig', ['releases'=>$releases]);
    }
}
