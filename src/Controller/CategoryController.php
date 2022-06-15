<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/category')]
class CategoryController extends AbstractController
{   
    #[Route('/', name: 'app_category_index', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository,Request $request): Response
    {  
         // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }
        
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(CategoryRepository $categoryRepository,Request $request): Response
    {   
          // on recupere d abord la session
          $session = $request->getSession();
          // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
          $email = $session->get('user-email', 'no');
          // donc s il ny a pas de mail on redirige vers la page de login
          if($email == "no"){
              return $this->redirect('/login');
          }

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_show', methods: ['GET'])]
    public function show(Category $category,Request $request): Response
    {   
          // on recupere d abord la session
          $session = $request->getSession();
          // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
          $email = $session->get('user-email', 'no');
          // donc s il ny a pas de mail on redirige vers la page de login
          if($email == "no"){
              return $this->redirect('/login');
          }

        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Category $category, CategoryRepository $categoryRepository,Request $request): Response
    {   
          // on recupere d abord la session
          $session = $request->getSession();
          // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
          $email = $session->get('user-email', 'no');
          // donc s il ny a pas de mail on redirige vers la page de login
          if($email == "no"){
              return $this->redirect('/login');
          }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Category $category, CategoryRepository $categoryRepository,Request $request): Response
    {   
          // on recupere d abord la session
          $session = $request->getSession();
          // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
          $email = $session->get('user-email', 'no');
          // donc s il ny a pas de mail on redirige vers la page de login
          if($email == "no"){
              return $this->redirect('/login');
          }

        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }
}
