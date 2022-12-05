<?php

namespace App\Repository;

use App\Entity\School;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<School>
 *
 * @method School|null find($id, $lockMode = null, $lockVersion = null)
 * @method School|null findOneBy(array $criteria, array $orderBy = null)
 * @method School[]    findAll()
 * @method School[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, School::class);
    }

    public function save(School $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(School $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function searchSchoolByPc($pc)
    {
        return $this->createQueryBuilder('s')
            ->where('s.postal_code like :val')
            ->setParameter('val', '%'.$pc.'%')
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getSchoolByName($name)
    {
        return $this->createQueryBuilder('s')
            ->where('s.name like :name')
            ->setParameter('name', '%'.$name.'%')
            ->orderBy('s.name', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function addSchool($name, $address, $postal_code, $city, $schoolRepository)
    {
        $newSchool = new School;
        $newSchool->setName($name);
        $newSchool->setAddress($address);
        $newSchool->setPostalCode($postal_code);
        $newSchool->setCity($city);
        
        $schoolRepository->save($newSchool, true);
    }

//    /**
//     * @return School[] Returns an array of School objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?School
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
