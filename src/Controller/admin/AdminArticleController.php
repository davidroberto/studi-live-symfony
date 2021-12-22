<?php


namespace App\Controller\admin;


use App\Entity\Article;
use App\Entity\User;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


    /**
     * @Route("/admin/article/{id}/delete", name="admin_article_delete")
     */
    public function deleteArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        $article = $articleRepository->find($id);

        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute("admin_articles");
    }

    /**
     * @Route("/admin/article/insert", name="admin_article_insert")
     */
    public function insertArticle(Request $request, EntityManagerInterface $entityManager)
    {
        $user = new User();

        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {

            $user->setRoles(["ROLE_ADMIN"]);

            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('admin/article_insert.html.twig', [
            'articleForm' => $articleForm->createView()
        ]);
    }

    /**
     * @Route("/admin/article/{id}/update", name="admin_article_update")
     */
    public function updateArticle($id, ArticleRepository $articleRepository, Request $request, EntityManagerInterface $entityManager)
    {
        // récupération d'un article en bdd
        $article = $articleRepository->find($id);

        $articleForm = $this->createForm(ArticleType::class, $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render('admin/article_insert.html.twig', [
            'articleForm' => $articleForm->createView()
        ]);
    }

}
