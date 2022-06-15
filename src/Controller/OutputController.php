<?php

namespace App\Controller;

use App\Entity\Output;
use App\Form\OutputType;
use App\Repository\OutputRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/output')]
class OutputController extends AbstractController
{
    #[Route('/', name: 'app_output_index', methods: ['GET'])]
    public function index(OutputRepository $outputRepository,Request $request): Response
    {   
          // on recupere d abord la session
          $session = $request->getSession();
          // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
          $email = $session->get('user-email', 'no');
          // donc s il ny a pas de mail on redirige vers la page de login
          if($email == "no"){
              return $this->redirect('/login');
          }

        return $this->render('output/index.html.twig', [
            'outputs' => $outputRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_output_new', methods: ['GET', 'POST'])]
    public function new(Request $request, OutputRepository $outputRepository): Response
    {   
        // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }

        $output = new Output();
        $form = $this->createForm(OutputType::class, $output);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outputRepository->add($output, true);

            return $this->redirectToRoute('app_output_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('output/new.html.twig', [
            'output' => $output,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_output_show', methods: ['GET'])]
    public function show(Output $output,Request $request): Response
    {   
        // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }

        return $this->render('output/show.html.twig', [
            'output' => $output,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_output_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Output $output, OutputRepository $outputRepository): Response
    {   
         // on recupere d abord la session
         $session = $request->getSession();
         // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
         $email = $session->get('user-email', 'no');
         // donc s il ny a pas de mail on redirige vers la page de login
         if($email == "no"){
             return $this->redirect('/login');
         }
         
        $form = $this->createForm(OutputType::class, $output);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $outputRepository->add($output, true);

            return $this->redirectToRoute('app_output_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('output/edit.html.twig', [
            'output' => $output,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_output_delete', methods: ['POST'])]
    public function delete(Request $request, Output $output, OutputRepository $outputRepository): Response
    {   
         // on recupere d abord la session
         $session = $request->getSession();
         // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
         $email = $session->get('user-email', 'no');
         // donc s il ny a pas de mail on redirige vers la page de login
         if($email == "no"){
             return $this->redirect('/login');
         }

        if ($this->isCsrfTokenValid('delete'.$output->getId(), $request->request->get('_token'))) {
            $outputRepository->remove($output, true);
        }

        return $this->redirectToRoute('app_output_index', [], Response::HTTP_SEE_OTHER);
    }
}
