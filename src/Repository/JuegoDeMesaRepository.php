<?php

namespace App\Repository;

use App\Entity\JuegoDeMesa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JuegoDeMesa>
 *
 * @method JuegoDeMesa|null find($id, $lockMode = null, $lockVersion = null)
 * @method JuegoDeMesa|null findOneBy(array $criteria, array $orderBy = null)
 * @method JuegoDeMesa[]    findAll()
 * @method JuegoDeMesa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegoDeMesaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuegoDeMesa::class);
    }

    public function save(JuegoDeMesa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(JuegoDeMesa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findAllJuegos(): JuegoDeMesa
    {
        return $this->createQueryBuilder('j')
            ->orderBy('j.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function findOneBySomeField($value): ?JuegoDeMesa
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function insertJuegoInSession(JuegoDeMesa $juego)
    {
        $session  = $this->get("session");
        serialize($juego);
        $session->set('juego',$juego);
    }
}
