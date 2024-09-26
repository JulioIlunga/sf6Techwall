<?php

namespace App\Controller;

use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class FirstController extends AbstractController
{
    #[Route('/first', name: 'first')]
    public function index(): Response
    {

        return $this->render('first/index.html.twig', [
            'name' => 'Ilunga',
            'firstname' => 'Elie'
         ]);
    }

    #[Route('/sayhello/{firstname}/{name}', name: 'say.hello')]
    public function sayHello(\Symfony\Component\HttpFoundation\Request $request, $name, $firstname): Response
    {
        return $this->render('first/hello.html.twig', [
            'nom' => $name,
            'prenom' => $firstname

        ]);
    }
}
