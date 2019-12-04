<?php

namespace App\Controller;

use App\Entity\Artist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $em)
    {

        //Lancer une exception

       /* throw new \Exception('Je suis une erreur');*/





        //       // return $this->json([
       //     'message' => 'Welcome to your new controller!',
         //   'path' => 'src/Controller/HomeController.php',
           // 'test'=>$request->query->get('exemple','default'),
            //'session' =>$session->has('cle inexistante')
        //return $this->render('_template.html.twig',['test'=>'<button>Cliquer moi</button>']);#)}
        /*dump($this);
        die;*/
        /*dd($this);*/
            //return $this->render('index.html.twig');
        /*création d'une nouvelle instance d'artiste*/

        $artist = (new Artist())
                ->setName('Komala')
                ->setDescription('pas un vrai artist...');
        //Insert/update
        $em->persist($artist);
        //Delete
        //$em->remove($entity);
        //Execution des requêtes sql
        $em->flush();

        return $this->render('index.html.twig');

    }
}
