<?php

namespace App\Repository;

use App\Entity\Mesa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mesa>
 *
 * @method Mesa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mesa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mesa[]    findAll()
 * @method Mesa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mesa::class);
    }

    public function save(Mesa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function toArray(Mesa $mesa) :array
    {
        return [
            $id=$mesa->getId(),
            $anchura=$mesa->getAnchura(),
            $longitud=$mesa->getLongitud(),
            $x=$mesa->getX(),
            $y=$mesa->getY()
        ];
    }

    public function remove(Mesa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Mesa[] Returns an array of Mesa objects
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

   public function findBySomeField($value,$value2): array
   {
       return $this->createQueryBuilder('m')
           ->andWhere('m.Anchura >= :val and m.Longitud >= :val2')
           ->setParameter('val', $value)
           ->setParameter('val2',$value2)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findByField($value): Mesa
   {
       return $this->createQueryBuilder('m')
           ->andWhere('m.id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
