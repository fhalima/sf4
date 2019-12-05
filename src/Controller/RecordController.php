<?php

namespace App\Controller;

use App\Entity\Record;
use App\Repository\RecordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/record", name="record_")
 */
class RecordController extends AbstractController
{
    /**
     * exemple: /record/42
     * @Route("/{id}", name="page")
     */
    public function index(Record $record)
    {
      //  return $this->json([
        //    'message' => 'Welcome to your new controller!',
         //   'path' => 'src/Controller/RecordController.php',
          //  'id'=> $id,
      //  ]);
        return $this->render('record/record_page.html.twig', ['record'=>$record]);
    }
}
