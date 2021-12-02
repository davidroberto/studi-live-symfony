<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/articles", name="articles")
     */
    public function articles()
    {
        // simulation d'articles récupérées depuis la bdd (SELECT * FROM article)
        $articles = [
            1 => [
                "title" => "article 1",
                "content" => "Contenu de l'article 1",
                "image" => "https://ionnews.mu/wp-content/uploads/2021/06/index-7.jpg",
                "isPublished" => true,
                "id" => 1
            ],
            2 => [
                "title" => "article 2",
                "content" => "Contenu de l'article 2",
                "image" => "https://ionnews.mu/wp-content/uploads/2021/06/index-7.jpg",
                "isPublished" => false,
                "id" => 3
            ],
            3 => [
                "title" => "article 3",
                "content" => "Contenu de l'article 3",
                "image" => "https://ionnews.mu/wp-content/uploads/2021/06/index-7.jpg",
                "isPublished" => true,
                "id" => 3
            ]
        ];

        return $this->render('articles.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("article/{id}", name="article")
     */
    public function article($id)
    {
        $articles = [
            1 => [
                "title" => "article 1",
                "content" => "Contenu de l'article 1",
                "image" => "https://ionnews.mu/wp-content/uploads/2021/06/index-7.jpg",
                "isPublished" => true,
                "id" => 1
            ],
            2 => [
                "title" => "article 2",
                "content" => "Contenu de l'article 2",
                "image" => "https://ionnews.mu/wp-content/uploads/2021/06/index-7.jpg",
                "isPublished" => false,
                "id" => 3
            ],
            3 => [
                "title" => "article 3",
                "content" => "Contenu de l'article 3",
                "image" => "https://ionnews.mu/wp-content/uploads/2021/06/index-7.jpg",
                "isPublished" => true,
                "id" => 3
            ]
        ];

        return $this->render('article.html.twig', [
            'article' => $articles[$id]
        ]);
    }
}
