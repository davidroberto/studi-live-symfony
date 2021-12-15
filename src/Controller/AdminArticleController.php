<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{

    /**
     * @Route("/admin/articles", name="admin_articles")
     */
    public function listArticles(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();

        return $this->render('admin/articles.html.twig', [
            'articles' => $articles
        ]);
    }


    // si un admin enregistré en bdd se connecte, il aura le droit de voir les pages de notre appli
    // si la personne n'est pas connectée (ou que les ids sont invalides), on l'empêche de voir les pages et on la redirige vers la connexion

}
