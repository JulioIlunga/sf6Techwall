<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nb<\d+>}', name: 'tab',
    defaults: ['nb' =>'5']
    )]
    public function index($nb): Response
    {
        $notes = [];
        for($i = 0; $i<$nb; $i++){
            $notes[] = rand(0,20);
        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        
        ]);
    }


    #[Route('/tab/users', name: 'tab.users')]

    public function users(){
        $users = [
            ['firstname' => 'Elie', 'name' => 'Ilunga', 'age' => '20'],
            ['firstname' => 'John', 'name' => 'Bulongo', 'age' => '4'],
            ['firstname' => 'Marcel', 'name' => 'Brown', 'age' => '68'],

        ];



        return $this->render('tab/users.html.twig', [
            'users' => $users
        ]);
    }
}
