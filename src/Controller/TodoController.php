<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use function mysql_xdevapi\getSession;


#[Route("/todo")] //pefixe permettant de faire un préfixe pour ne pas repeter /todo à chaque routes de notre controller.

class TodoController extends AbstractController
{

    #[Route('/', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        // Afficher note tableau de todo
        // Sinon je l'initialise pui sj'affiche
        if (!$session->has('todos')) {
            $todos = [
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste des todos vient d'être initialisée");
        }
        return $this->render('todo/index.html.twig');
    }

    
    //============================================================================================

    #[Route(
        '/add/{name}/{content}', 
        name: 'todo.add', 
        defaults: ['content' => 'default value']
        )]
    public function addTodo(Request $request, $name, $content)
    {
        $session = $request->getSession();
           //Afficher notre tableau de todo
        //Sinon on initialize et on l'affiche
        if ($session->has('todos')) {
            //Si oui
            //Vérifier si on a un todo ayant le même nom
            $todos = $session->get('todos');
            //Si oui, afficher un message d'erreur
            if(isset($todos[$name])){
                $this->addFlash('error', "Le todo $name existe déjà");

            } else {
                //si non, afficher un message de succès et ajouter le toto à la liste
                $todos[$name] =$content;
                $this->addFlash('success',"Le todo $name vient d'être ajouté");

                $session->set('todos',$todos);
            }

        } else {
            //si non, affichr un message d'erreur et rediriger vers le controlleur index.
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");

        }

        return $this->redirectToRoute('todo');
    }
    //============================================================================================

    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function updateTodo(Request $request, $name, $content){
        $session = $request->getSession();
           //Afficher notre tableau de todo
        //Sinon on initialize et on l'affiche
        if ($session->has('todos')) {
            //Si oui
            //Vérifier si on a un todo ayant le même nom
            $todos = $session->get('todos');
            //Si oui, afficher un message d'erreur
            if(!isset($todos[$name])){
                $this->addFlash('error', "Le todo $name n'existe pas");

            } else {
                //si non, afficher un message de succès et modifer le todo de la liste
                $todos[$name] =$content;
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todo $name a été modifié avec succès");

            }

        } else {
            //si non, affichr un message d'erreur et rediriger vers le controlleur index.
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");

        }

        return $this->redirectToRoute('todo');
    }
    //============================================================================================
    #[Route('/delete/{name}', name: 'todo.delete')]

    public function deleteTodo(Request $request, $name)
    {
        $session = $request->getSession();
           //Afficher notre tableau de todo
        //Sinon on initialize et on l'affiche
        if ($session->has('todos')) {
            //Si oui
            //Vérifier si on a un todo ayant le même nom
            $todos = $session->get('todos');
            //Si oui, afficher un message d'erreur
            if(!isset($todos[$name])){
                $this->addFlash('error', "Le todo $name n'existe pas");

            } else {
                //si non, afficher un message de succès et modifer le todo de la liste
                unset($todos[$name]);
                $session->set('todos',$todos);
                $this->addFlash('success',"Le todo $name a été suppprimé avec succès");

            }

        } else {
            //si non, affichr un message d'erreur et rediriger vers le controlleur index.
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");

        }

        return $this->redirectToRoute('todo');
    }
    //============================================================================================

    #[Route('/reset', name: 'todo.reset')]
    public function resetTodo(Request $request){
        $session= $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('todo');
    }

}
