<?php

namespace App\Controller;

use Doctrine\DBAL\Schema\Index;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class FirstController extends AbstractController
{

    #[Route('template', name:'template'
    )]

    public function template(){


        return $this->render('template.html.twig');
    }
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
            'prenom' => $firstname,
            'path' => '        '

        ]);
    }

    


    #[Route('times/{entier1}/{entier2}', name:'multiplication',
    requirements: ['entier1' => '\d+','entier2' => '\d+'],
    )]

    public function multiplication($entier1,$entier2){

        $result = $entier1 * $entier2;
        return new Response("<h1>$result</h1>");
     }


    //  #[Route('{maVar}', name: 'test.order.route')]
    // public function testOrderRoute($maVar){
    //     return new Response("

    //     <html>
    //         <body>
    //         $maVar
    //         </html>
    //     </body>
    //     ");
    // }


}
