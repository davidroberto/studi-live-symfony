<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{

    /**
     * @Route("/articles", name="articles")
     */
    // je passe en parametre de la méthode la classe ArticleRepository suivie
    // d'une variable (je type la variable)
    // Ca permet de demander à symfony d'instancier la classe en question à notre
    // place, c'est ce qu'on appelle l'autowire
    public function articles(ArticleRepository $articleRepository)
    {
        // une fois que j'ai récupéré l'instance de la classe
        // je peux utiliser les méthodes de la classe, dont
        // la méthode findAll qui me permet de récupérer tout ce qu'il y a
        // dans la table article
        $articles = $articleRepository->findAll();

        return $this->render('articles.html.twig', [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function article($id, ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);

        return $this->render('article.html.twig', [
            'article' => $article
        ]);
    }


    /**
     * @Route("/search-results", name="search")
     */
    public function searchArticle(Request $request, ArticleRepository $articleRepository)
    {
        $search = $request->query->get('search');

        $articles = $articleRepository->searchArticle($search);

        return $this->render('search_articles.html.twig', [
            'articles' => $articles,
            'search' => $search
        ]);
    }

}
