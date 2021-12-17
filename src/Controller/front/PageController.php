<?php


namespace App\Controller\front;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $message = "Bonjour Studi";

        return $this->render('home.html.twig', [
            'message' => $message
        ]);
    }

}
