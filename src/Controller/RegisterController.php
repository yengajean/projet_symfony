<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/auth')]
class RegisterController extends AbstractController
{
    // #[Route('/rigolo', name: 'app_rigolo')]
    // public function index(): Response
    // {
    //     return $this->render('register/index.html.twig');
    // }

    #[Route('/rigolo', name: 'app_rigolo')]
    public function index(Request $request): Response
    {

        // verifier s il sagit d une requete get ou post

        // si get retourner la page du formulaire

        // si post recuperer les infos et les afficher

        // recuperer la methode

        $method = $request->getMethod(); 

        if($method == "POST") {

            // ICI ON RECUPER LES DONNES ET ON LES AFFICHE,
            // APRES IL FAUDRA LES STOCKER EN BASE DE DONNE

            //dd($request); // C EST UNE FONCTION POUR DEBUGGER QUI AFFICHE TOUS LES INFOS D UNE REQUETE

            $email = $request->request->get('email');
            $password = $request->request->get('password');

            //dd($password);

            // verifier que le mail n existe pas deja dans la base

            // ensuite crypter le mot de passe et stocker le mail et le pass crypter dans la base

            // stocker le user dans la session

            // rediriger vers le dashboard

            // avant de passer au stockage en base de donnee, on va deja simuler l usage avec la session

            // donc on va stocker le mail du user dans la session

            // on va ensuite rediriger le user vers le dashboard

            // on va s assurer que le dashboard est inaccessible tant qu il n y a pas un mail dans la session


        }

        return $this->render('register/index.html.twig');
    }
}
