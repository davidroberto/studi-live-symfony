<?php


namespace App\Controller\admin;


use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{

    /**
     * @Route("/admin/categories", name="admin_categories")
     */
    public function listCategories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin/categories.html.twig', [
           'categories' => $categories
        ]);
    }

    /**
     * @Route("/admin/category/{id}/delete", name="admin_category_delete")
     */
    public function deleteCategory($id, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        $this->addFlash('success', 'La catégorie a bien été supprimée !');

        return $this->redirectToRoute("admin_categories");
    }

    /**
     * @Route("/admin/category/insert", name="admin_category_insert")
     */
    public function insertCategory(Request $request, EntityManagerInterface $entityManager)
    {
        $category = new Category();

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'La catégorie a bien été créée !');

            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/category_insert.html.twig', [
           'categoryForm' => $categoryForm->createView()
        ]);
    }


    /**
     * @Route("/admin/category/{id}/update", name="admin_category_update")
     */
    public function updateCategory($id, CategoryRepository $categoryRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $categoryForm = $this->createForm(CategoryType::class, $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'La catégorie a bien été mise à jour !');

            return $this->redirectToRoute('admin_categories');
        }

        return $this->render('admin/category_update.html.twig', [
            'categoryForm' => $categoryForm->createView()
        ]);
    }

}
