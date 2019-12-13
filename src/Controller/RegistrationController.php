<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationFormType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\Smtp\Auth\AuthenticatorInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index(Request $request,
                          UserPasswordEncoderInterface $passwordEncoder,
                          EntityManagerInterface $entityManager
                         )
    {

        $user = new User();
        $registerForm = $this->createForm(UserRegistrationFormType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {

            $user = $registerForm->getData();
            $password = $passwordEncoder->encodePassword($user, $registerForm->getViewData('plainPassword'));
            $user->setPassword($password);
            $user->setIsConfirmed(false);
            $user->setRoles(['ROLE_USER']);
            $user->renewToken();

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre profil a été bien enregistrer.
                    Un message de confirmation vous a été envoyé, Veuillez consulter votre boite mail! '
            );
            //Envoi d'Email de confirmation

            $email = SendEmail($user);


            return $this->redirectToRoute('confirmation_page');
//            }
        }

        return $this->render(
            'registration/register.html.twig',
            array('register_form' => $registerForm->createView(), ['user' => $user])
        );
    }
    /**
     * @Route("/user-confirmation/{pseudo}/{token}", name="user_confirmation")
     */
    public function userConfirmation(EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository)
    {
        $pseudo = $request->get('pseudo');
        $token = $request->get('token');
        $user = $userRepository->loadUserByUsername($pseudo);
        if($user->getIsConfirmed()===true){
            $this->addFlash(
                'warning',
                'Votre Compte a déjà  été activé ! '
            );
        }else
        {
            if($user->getSecurityToken() == $token) {

                $user->setIsConfirmed(true);
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Votre Compte a bien été activé ! '
                );
                return $this->redirectToRoute('app_login');
            }
            else
                $this->addFlash(
                    'error',
                    'Vous tentez d\'activer un compte qui n\'existe pas  ! '
                );

        }



        $this->redirectToRoute('confirmation_page');
    }

    /**
     * @Route("/confirmation-page", name="confirmation_page")
     */
    public function passwordForgotten()
    {
        return $this->render('registration/confirmation_page.html.twig');
    }

    /**
     * @Route("/confirmation-page", name="confirmation_page")
     */
    public function SendEmail(Entity $user,  MailerInterface $mailer)
    {
        $email = (new TemplatedEmail())
            ->from('ghazaloran2@gmail.com')
            ->to(new Address($user->getEmail()))
            ->subject('Confirmation d\'inscription!')
            // path of the Twig template to render
            ->htmlTemplate('mailer/user_confirmation.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'pseudo' =>$user->getPseudo() ,
                'token'=>$user->getSecurityToken()
            ]);
        $mailer->send($email);
        return $email;
    }

    /**
     * @Route("/confirmation-page", name="confirmation_page")
     */
    public function Confirmation_page()
    {
        return $this->render('registration/confirmation_page.html.twig');
    }
}
