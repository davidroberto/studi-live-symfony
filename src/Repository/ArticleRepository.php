<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function searchArticle(string $search): array
    {
        $qb = $this->createQueryBuilder('article');

        $query = $qb->select('article')
            ->where('article.title LIKE :search')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery();

        return $query->getResult();
    }

}
