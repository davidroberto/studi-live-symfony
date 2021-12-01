<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
       return new Response('Hello Studi');
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return new Response("contact@david-robert.fr");
    }


    /**
     * @Route("/poker", name="poker")
     */
    public function poker()
    {
        $request = Request::createFromGlobals();
        $age = $request->query->get('age');

        if ($age < 18) {
            return $this->redirectToRoute("digimon");
        }

        return new Response("Bienvenue sur mon super site de poker, dépensez du fric sans compter");
    }

    /**
     * @Route("/digimon", name="digimon")
     */
    public function digimon()
    {
        return new Response("Les super Digimons qui se transforment en tank dès la première évolution");
    }

}
