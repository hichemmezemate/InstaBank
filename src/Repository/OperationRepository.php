<?php

namespace App\Repository;

use App\Entity\Operation;
use App\Entity\Search;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Operation>
 *
 * @method Operation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Operation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Operation[]    findAll()
 * @method Operation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operation::class);
    }

    public function findSearch($comte_id, Search $search) {
        $query = $this->createQueryBuilder('o')
            ->where('o.compte = :compte_id')
            ->setParameter('compte_id', $comte_id);

        if (!empty($search->budgets)) {
            $query = $query
                ->andWhere('o.budget IN (:budgets)')
                ->setParameter('budgets', $search->budgets);
        }

        return $query->getQuery()->execute();
    }

//    public function getOperationsByCompte(int $id) {
//        $em = $this->getEntityManager();
//        $query = $em->createQuery('
//        SELECT o
//        FROM App\Entity\Operation o
//        JOIN o.compte c
//        WHERE c.user = :user
//        ')->setParameter('user', $id);
//
//        return $query->getResult();
//    }
//
//    public function getOperationCompte(int $id) {
//        $qb = $this->createQueryBuilder('o')
//            ->join('App\Entity\Compte', 'c', Join::WITH, 'o.compte = :compte_id')
//            ->setParameter('compte_id', $id);
//    }

//    /**
//     * @return Operation[] Returns an array of Operation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Operation
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
