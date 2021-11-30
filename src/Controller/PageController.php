<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController
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
            return new Response('Dégage morveux');
        }

        return new Response("Bienvenue sur mon super site de poker, dépensez du fric sans compter");
    }

}
