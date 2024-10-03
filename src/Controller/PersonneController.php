<?php

namespace App\Controller;

use App\Entity\Personne;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/personne')]
class PersonneController extends AbstractController
{
    #[Route('/', name: 'personne.list')]

    public function index(ManagerRegistry $doctrine){
    $repository = $doctrine->getRepository(Personne::class);
    $personnes = $repository->findAll();
    return$this->render('personne/index.html.twig', ['personnes' => $personnes]);

    }

    #[Route('/{id<\d+>}', name: 'personne.detail')]

    public function detail(Personne $personne = null){

        if(!$personne){
            $this->addFlash('error', "La personne n'existe pas");
            return $this->redirectToRoute('personne.list');

        }
        return$this->render('personne/detail.html.twig', ['personne' => $personne]);
    }
    #[Route('/add', name: 'personne.add')]
    public function addPersonne(ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();
        $personne = new Personne();


        $entityManager->persist($personne);

        $entityManager->flush();
        return $this->render('personne/detail.html.twig', [
            'personne' => $personne,
        ]);
    }

    #[Route('/alls/{page?1}/{nbre?12}', name: 'personne.list.alls')]

        public function indexAlls(ManagerRegistry $doctrine, $page, $nbre){
            $repository = $doctrine->getRepository(Personne::class);
            $nbPersonne = $repository->count([]);
            $nbPages = ceil($nbPersonne / $nbre);
            $personnes = $repository->findBy([], [], $nbre, ($page-1)* $nbre);
            return$this->render('personne/index.html.twig', [
                'personnes' => $personnes,
                'isPaginated' => true,
                'nbrePage' => $nbPages,
                'page' => $page,
                'nbre
                ' => $nbre
            ]);

        }

}
