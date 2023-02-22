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
    public function findByExampleField($sysdate): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.Fecha_evento >= :val')
            ->setParameter('sysdate', $sysdate)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByNombre($nombre): Evento
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.Nombre = :nombre')
            ->setParameter('nombre', $nombre)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findEventosByID(Evento $evento, $id)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = 'select * from evento e join evento_usuario u on e.id=u.evento_id  where usuario_id=' . $id . ' and fecha_evento>=curdate() group by id';
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function findEventoByNombre($nombre) : Evento
    {
        return $this->createQueryBuilder('e')
        ->andWhere('e.Nombre = :val')
        ->setParameter('val', $nombre)
        ->getQuery()
        ->getOneOrNullResult();
    }

    public function findEventosByIDallDates(Evento $evento, $id)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = 'select * from evento e join evento_usuario u on e.id=u.evento_id  where usuario_id=' . $id . ' and fecha_evento<=curdate() group by id';
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function findJuegosDeEventoByID(Evento $evento, $id)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = 'select m.nombre from evento e join evento_juego_de_mesa j on e.id=j.evento_id join juego_de_mesa m on j.juego_de_mesa_id=m.id where evento_id='.$id;
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();
        return $result->fetchAllAssociative();
    }

    
    public function insertInUsuariosEvento(Evento $evento, $id,$idevento)
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = 'insert into evento_usuario(evento_id,usuario_id) values (' .$idevento. ',' .$id. ')';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery();
    }

    public function updateAsistencia(Evento $evento, $asiste, $juegoid,$eventoid)
    {
        if ($asiste) {
            $conn = $this->getEntityManager()
                ->getConnection();
            $sql = 'update evento_usuario set asiste=true where usuario_id=' . $juegoid . ' and evento_id=' .$eventoid;
            $stmt = $conn->prepare($sql);
            $stmt->executeQuery();
        }
        else {
            $conn = $this->getEntityManager()
                ->getConnection();
            $sql = 'update evento_usuario set asiste=false where usuario_id=' . $juegoid . ' and evento_id=' .$eventoid;
            $stmt = $conn->prepare($sql);
            $stmt->executeQuery();
        }
    }
}
