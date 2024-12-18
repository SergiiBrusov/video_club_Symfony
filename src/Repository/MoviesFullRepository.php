<?php

namespace App\Repository;

use App\Entity\MoviesFull;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MoviesFull>
 */
class MoviesFullRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MoviesFull::class, User::class);
    }

//    /**
//     * @return MoviesFull[] Returns an array of MoviesFull objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
public function searchBy($champ, $value, $limit):array{

    return $this->createQueryBuilder('m')
    ->andWhere("m.$champ LIKE :val")
    ->setParameter('val',"%$value%")
    ->setMaxResults($limit)
    ->getQuery()
    ->getResult();
}
//    public function findOneBySomeField($value): ?MoviesFull
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
