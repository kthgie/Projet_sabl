<?php

namespace App\Repository;

use App\Entity\ThemeOeuvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ThemeOeuvre>
 *
 * @method ThemeOeuvre|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThemeOeuvre|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThemeOeuvre[]    findAll()
 * @method ThemeOeuvre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeOeuvreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThemeOeuvre::class);
    }

    public function add(ThemeOeuvre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ThemeOeuvre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ThemeOeuvre[] Returns an array of ThemeOeuvre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ThemeOeuvre
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
