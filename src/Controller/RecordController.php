<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Record;
use App\Form\NoteFormType;
use App\Repository\NoteRepository;
use App\Repository\RecordRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/record", name="record_")
 */
class RecordController extends AbstractController
{
    /**
     * exemple: /record/42
     * @Route("/{id}", name="page")
     */
    public function index(EntityManagerInterface $entityManager,
                          Request $request,
                          Record $record,
                          NoteRepository $noteRepository,
                          Security $security)
    {
        //  return $this->json([
        //    'message' => 'Welcome to your new controller!',
        //   'path' => 'src/Controller/RecordController.php',
        //  'id'=> $id,
        //  ]);
        //traiter le formulaire uniquement lorsque connecté
        if ($security->isGranted('ROLE_USER')) {
            $note = $noteRepository->findOneBy([
                'record' => $record,
                'user' => $this->getUser()
            ]);
            if ($note === null) {
                $note = (new Note())
                    ->setRecord($record)
                    ->setUser($this->getUser());
            }
//
            $noteForm = $this->createForm(NoteFormType::class, $note);
            $noteForm->handleRequest($request);

            if ($noteForm->isSubmitted() && $noteForm->isValid()) {
                $note = $noteForm->getData();
//                dd($note);
                $entityManager->persist($note);

                $entityManager->flush();

                $this->addFlash('success', 'Note enregistrée');
            }
        }


        return $this->render('record/record_page.html.twig', [
            'record' => $record,
            'note_form'=> isset($noteForm) ? $noteForm->createView(): null
            ]);
    }
}
