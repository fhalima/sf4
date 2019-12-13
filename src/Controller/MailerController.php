<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/email/{email}/{token}", name="email")
     */
    public function sendEmail()
    {
//        $email = (new Email())
//            ->from($email)
//            ->to('you@example.com')
//            //->cc('cc@example.com')
//            //->bcc('bcc@example.com')
//            //->replyTo('fabien@example.com')
//            //->priority(Email::PRIORITY_HIGH)
//            ->subject('Time for Symfony Mailer!')
//            ->text('Sending emails is fun again!')
//            ->html('<p>See Twig integration for better HTML integration!</p>');
//
//        $mailer->send($email);

        return $this->render('user_confirmation.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
