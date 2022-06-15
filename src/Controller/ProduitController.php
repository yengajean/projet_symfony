<?php

namespace App\Controller;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]        
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProductRepository $productRepository, Request $request): Response
    {

        // nous sommes dans la route du dashboard

        // on va bloquer son acces en verifiant si la session contient un email ou pas

        // donc il faut chercher comment on verifie dans la session la presence d un element

        // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }



        $products = $productRepository->findAll();

        $title = $request->query->get("title");

        if($title !== null) {
            $products = $productRepository->findBy(['title' => $title]);
        }

        return $this->render('produit/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(ProductRepository $productRepository,Request $request): Response
    {
        // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Product $product,Request $request): Response
    {
        // on recupere d abord la session
        $session = $request->getSession();
        // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
        $email = $session->get('user-email', 'no');
        // donc s il ny a pas de mail on redirige vers la page de login
        if($email == "no"){
            return $this->redirect('/login');
        }
        
        return $this->render('produit/show.html.twig', [
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Product $product, ProductRepository $productRepository,Request $request): Response
    {   
         // on recupere d abord la session
         $session = $request->getSession();
         // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
         $email = $session->get('user-email', 'no');
         // donc s il ny a pas de mail on redirige vers la page de login
         if($email == "no"){
             return $this->redirect('/login');
         }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($product, true);

            return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('produit/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Product $product, ProductRepository $productRepository,Request $request): Response
    {   
         // on recupere d abord la session
         $session = $request->getSession();
         // ensuite on prend le mail. si il n y a pas de mail on va supposer que la valeur c est no
         $email = $session->get('user-email', 'no');
         // donc s il ny a pas de mail on redirige vers la page de login
         if($email == "no"){
             return $this->redirect('/login');
         }
         
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product, true);
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
