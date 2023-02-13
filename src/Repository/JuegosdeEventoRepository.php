<?php


namespace App\Repository;


use App\Entity\JuegosDeEvento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<JuegosDeEvento>
 *
 * @method JuegosDeEvento|null find($id, $lockMode = null, $lockVersion = null)
 * @method JuegosDeEvento|null findOneBy(array $criteria, array $orderBy = null)
 * @method JuegosDeEvento[]    findAll()
 * @method JuegosDeEvento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegosdeEventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuegosDeEvento::class);
    }


    public function save(JuegosDeEvento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);


        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    public function remove(JuegosDeEvento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);


        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


//    /**
//     * @return JuegosDeEvento[] Returns an array of JuegosDeEvento objects
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


//    public function findOneBySomeField($value): ?JuegosDeEvento
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}





