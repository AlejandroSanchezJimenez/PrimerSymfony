<?php

namespace App\Repository;

use App\Entity\Reserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reserva>
 *
 * @method Reserva|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reserva|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reserva[]    findAll()
 * @method Reserva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserva::class);
    }

    public function save(Reserva $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reserva $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Reserva[] Returns an array of Reserva objects
//     */
   public function findAll(): array
   {
       return $this->createQueryBuilder('r')
        //    ->andWhere('r.exampleField = :val')
        //    ->setParameter('val', $value)
           ->orderBy('r.id', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findallbyid($value,$value2): array
   {
       return $this->createQueryBuilder('r')
           ->andWhere('r.idUsuario = :val')
           ->andWhere('r.Fecha_cancelacion is NULL')
           ->andWhere('r.Dia_reserva >= :val2')
           ->setParameter('val', $value)
           ->setParameter('val2', $value2)
           ->orderBy('r.id', 'ASC')
        //    ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findIfReservaExist($value,$value2,$value3,$value4,$value5): ?Reserva
   {
       return $this->createQueryBuilder('r')
           ->andWhere('r.Dia_reserva = :val')
           ->andWhere(':val2 between r.Hora_entrada and r.Hora_salida OR :val3 between r.Hora_entrada and r.Hora_salida')
           ->andWhere('r.Mesa = :val4')
           ->andWhere('r.Dia_reserva >= :val5')
           ->setParameter('val', $value)
           ->setParameter('val2', $value2)
           ->setParameter('val3', $value3)
           ->setParameter('val4', $value4)
           ->setParameter('val5', $value5)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }

   public function findJuegosPopulares(): array
    {
        return $this->createQueryBuilder('r')
            ->leftjoin('r.Juego','j')
            //    ->andWhere('j.exampleField = :val')
            //    ->setParameter('val', $value)
            ->groupBy('r.Juego')
            ->orderBy('count(r.Juego)', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    public function findJuegosJugados($value,$value2): array
    {
        return $this->createQueryBuilder('r')
            ->leftjoin('r.Juego','j')
               ->andWhere('r.Dia_reserva <= :val')
               ->andWhere('r.Presentado = true')
               ->andWhere('r.idUsuario = :val2')
               ->setParameter('val', $value)
               ->setParameter('val2', $value2)
            ->orderBy('r.Dia_reserva', 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    public function cancelaReserva($value,$value2)
    {
        return $this->createQueryBuilder('r')
            ->update()
            ->set('r.Fecha_cancelacion', ':val')
            ->andWhere('r.id = :val2')
            ->setParameter('val', $value)
            ->setParameter('val2', $value2)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
