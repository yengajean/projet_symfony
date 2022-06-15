<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
   // #[Route('/login', name: 'app_login')]
    //public function index(): Response
   // {
    //    return $this->render('login/index.html.twig', [
     //       'controller_name' => 'LoginController',
      //  ]);
   // }




    #[Route('/login', name: 'app_login')]
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

            // il faut verifier ensuite si dans la base le user existe bien

            // apres on met le mail en session et on redirige vers le dashboard
            $session = $request->getSession();
            $session->set('user-email', $email);

            return $this->redirect('/');
        }
    

    
        return $this->render('login/index.html.twig');
    } 
}
