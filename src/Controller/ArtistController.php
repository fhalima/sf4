<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artist", name="artist_")
 */
class ArtistController extends AbstractController
{
    /**
     * URL:/artist/list
     * NOM:artist_list
     * @Route("/list", name="list")
     */
    public function index(ArtistRepository $artistRepository)
    {
        return $this->render('artist/list.html.twig',['artist_list'=>$artistRepository->findAll()]);
        //return $this->json([
           // 'message' => 'Welcome to your new controller!',
           // 'path' => 'src/Controller/ArtistController.php',
       // ]);
    }
    /**
     * @Route("/{id}", name="page")
     */

    public function page(Artist $artist)
    {
        return $this->render('artist/artist_page.html.twig',['artist'=>$artist]);
        //return $this->json([
        // 'message' => 'Welcome to your new controller!',
        // 'path' => 'src/Controller/ArtistController.php',
        // ]);
    }
}
