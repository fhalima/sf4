<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artist", name="artist_")
 */
class ArtistController extends AbstractController
{
    /**
     * URL:/artist_list
     * NOM:artist_list
     * @Route("_list", name="list")
     */
    public function index()
    {
        return $this->render('artist/list.html.twig');
        //return $this->json([
           // 'message' => 'Welcome to your new controller!',
           // 'path' => 'src/Controller/ArtistController.php',
       // ]);
    }
}
