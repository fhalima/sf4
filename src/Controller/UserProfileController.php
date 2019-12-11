<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserProfileFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile", name="user_")
 */
class UserProfileController extends AbstractController
{
    /**
     * @Route("/", name="profile")
     */
    public function index(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        //recupération de l'utilisateur courant
          $user = $this->getUser();
//passage de l'utilisateur au formulaire pour pré remplirles champs du formulaire
        $profileForm = $this->createForm(UserProfileFormType::class, $user);
        $profileForm->handleRequest($request);
//        $user = $profileForm->getData();

        //vérification de validité
        if ($profileForm->isSubmitted() && $profileForm->isValid()) {
            $user = $profileForm->getData();

            $entityManager->persist($user);
            $entityManager->flush()
            ->addFlash(
                'success',
                'Votre profil a été mis à jour.'
            );

//            }
        }


        return $this->render('user/profile.html.twig', [
            'user' => $user, 'profile_form' => $profileForm->createView()
        ]);

        /*
         * User (0,n) --> (1,1) Note (1,1)--> (0,n) Record
         */
    }

    /* public function addUSer(Request $request)
     {
         $user = new User();

         $form = $this->createForm(UserProfileFormType::class);

         if($form->isSubmitted() && $form->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $user->setPseudo( $form->getData()['name']);
             $user->setEmail( $form->getData()['email']);
             $user->setPassword( $form->getData()['password']);
             $user->setRoles( ['ROLE_USER']);

             $em->persist($user);

             $em->flush();

             if ($request->isMethod('POST')) {
                 $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
             }

            // return $this->redirectToRoute('jm_employee_detail', array('id' => $employee->getId()));
         }

         return $this->render('JMEmployeeBundle:Employee:add.html.twig', array('user'=>$user,'form' => $form->createView(),
         ));
     }*/
}
