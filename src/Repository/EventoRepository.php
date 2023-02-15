<?php

namespace App\Repository;

use App\Entity\Evento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evento>
 *
 * @method Evento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evento[]    findAll()
 * @method Evento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evento::class);
    }

    public function save(Evento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Evento $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Evento[] Returns an array of Evento objects
//     */
   public function findByExampleField($value): array
   {
       return $this->createQueryBuilder('e')
           ->andWhere('e.Fecha_evento >= :val')
           ->setParameter('val', $value)
           ->orderBy('e.id', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findByNombre($value): Evento
   {
       return $this->createQueryBuilder('e')
           ->andWhere('e.Nombre = :val')
           ->setParameter('val', $value)
        //    ->orderBy('e.id', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }

   public function findIfAsiste($id,$date): array
   {
       return $this->createQueryBuilder('e')
           ->andWhere('e.ParticipanEvento = :val')
           ->andWhere('e.Fecha_evento >= :val')
           ->setParameter('val', $id)
           ->setParameter('val2', $date)
           ->orderBy('e.id', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Evento
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
