<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout', name: 'app_logout')]
    public function index(Request $request): Response
    {

        // vider la session
       $session = $request->getSession();
       $session->invalidate();

        // rediriger vers la page de connection
        return $this->redirect('/login');
    }
}
