<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{

    /**
     * @Route("/article/{id}", name="article", requirements={"id"="\d+"})
     */
    public function article(int $id)
    {
        // simulation d'une requête SQL "SELECT * FROM article"
        $articles = [
            1 => [
                "title" => "Article 1",
                "content" => "Contenu de l'article 1",
                "id" => 1
            ],
            2 => [
                "title" => "Article 2",
                "content" => "Contenu de l'article 2",
                "id" => 2
            ],
            3 => [
                "title" => "Article 3",
                "content" => "Contenu de l'article 3",
                "id" => 3
            ]
        ];

        if (!array_key_exists($id, $articles)) {
            return new Response("L'article n'existe pas", 404);
        }

        $article = $articles[$id];

        return new Response($article['title']);
    }

}
