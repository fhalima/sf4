<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\Artist\SearchFormType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request, ArtistRepository $artistRepository)
    {

        //Creation du formulaire
        $form = $this->createForm(SearchFormType::class);
        //traitement de la requete par le formulakire
        $form->handleRequest($request);
        //si le formulaire est envoyé et valide
        if($form->isSubmitted() && $form->isValid()){
            $recherche = $form->getData()['name'];
         //   dd($data);
            $list = $artistRepository->searchByName($recherche);
            $title = sprintf("Résultat de recherche pour %s", $recherche);
        }
        else {
            $list = $artistRepository->findAll();
            $title = 'Artistes';
        }

        return $this->render('artist/list.html.twig',[
            'artist_list'=>$list,
            'title' => $title,
            'search_form'=>$form->createView()]);
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
