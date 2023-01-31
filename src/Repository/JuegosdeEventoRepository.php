<?php

namespace App\Repository;

use App\Entity\JuegosdeEvento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JuegosdeEvento>
 *
 * @method JuegosdeEvento|null find($id, $lockMode = null, $lockVersion = null)
 * @method JuegosdeEvento|null findOneBy(array $criteria, array $orderBy = null)
 * @method JuegosdeEvento[]    findAll()
 * @method JuegosdeEvento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegosdeEventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuegosdeEvento::class);
    }

    public function save(JuegosdeEvento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JuegosdeEvento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return JuegosdeEvento[] Returns an array of JuegosdeEvento objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JuegosdeEvento
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
