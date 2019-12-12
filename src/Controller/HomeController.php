<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\RecordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @ Is Granted("ROLE_ADMIN")
     */
    public function index(RecordRepository $recordRepository)
    {
        $top = $recordRepository->getBestRatedOfYear();
//        dd($top);

        return $this->render('index.html.twig',['top'=>$top]);

    }
}
