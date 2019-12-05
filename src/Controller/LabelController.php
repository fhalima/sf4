<?php

namespace App\Controller;

use App\Entity\Label;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/label", name="label_")
 */
class LabelController extends AbstractController
{
    /**
     * @Route("/{id}", name="page")
     */
    public function index(Label $label)
    {
       // return $this->json([
      //      'message' => 'Welcome to your new controller!',
       //     'path' => 'src/Controller/LabelController.php',
       //     'id'=> $id,
      //  ]);
        return $this->render('label/label_page.html.twig', ['label'=>$label]);

    }
}
