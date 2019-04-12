<?php

namespace App\Repository;

use App\Entity\PollCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PollCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method PollCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method PollCharacter[]    findAll()
 * @method PollCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PollCharacterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PollCharacter::class);
    }

    // /**
    //  * @return PollCharacter[] Returns an array of PollCharacter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PollCharacter
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
