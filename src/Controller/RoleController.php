<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/role')]
class RoleController extends AbstractController
{

  


    #[Route('/admin', name: 'app_role_index', methods: ['GET'])]
    public function index(RoleRepository $roleRepository,Request $request): Response
    {   
          // on recupere d abord la session
          $session = $request->getSession();
          // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
          $email = $session->get('user-email', 'no');
          // donc s il ny a pas de mail on redirige vers la page de login
          if($email == "no"){
              return $this->redirect('/login');
          }

        return $this->render('role/index.html.twig', [
            'roles' => $roleRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RoleRepository $roleRepository): Response
    {   
         // on recupere d abord la session
         $session = $request->getSession();
         // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
         $email = $session->get('user-email', 'no');
         // donc s il ny a pas de mail on redirige vers la page de login
         if($email == "no"){
             return $this->redirect('/login');
         }

        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roleRepository->add($role, true);

            return $this->redirectToRoute('app_role_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('role/new.html.twig', [
            'role' => $role,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_role_show', methods: ['GET'])]
    public function show(Role $role,Request $request): Response
    {   
         // on recupere d abord la session
         $session = $request->getSession();
         // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
         $email = $session->get('user-email', 'no');
         // donc s il ny a pas de mail on redirige vers la page de login
         if($email == "no"){
             return $this->redirect('/login');
         }

        return $this->render('role/show.html.twig', [
            'role' => $role,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_role_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Role $role, RoleRepository $roleRepository): Response
    {   
        // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }

        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roleRepository->add($role, true);

            return $this->redirectToRoute('app_role_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('role/edit.html.twig', [
            'role' => $role,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_role_delete', methods: ['POST'])]
    public function delete(Request $request, Role $role, RoleRepository $roleRepository): Response
    {   
        // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }
        
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $roleRepository->remove($role, true);
        }

        return $this->redirectToRoute('app_role_index', [], Response::HTTP_SEE_OTHER);
    }
}
