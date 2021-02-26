<?php

namespace App\Repository;

use App\Entity\Apport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apport[]    findAll()
 * @method Apport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apport::class);
    }

    // /**
    //  * @return Apport[] Returns an array of Apport objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function updateApportByPlateforme($plateforme, $amount)
    {
        //Requête pour trouver le montant d'apport actuelle sur la plateforme
        $qb = $this->createQueryBuilder('p')
        ->select('p.apport')
        ->where('p.plateforme = ?1')
        ->setParameter(1, $plateforme);

        $amountQuerry = $qb->getQuery()->getResult();
        $actualAmount = $amountQuerry[0]["apport"];

        //Ajoute le montant passé en paramètre
        (int)$totalAmount = (int)$actualAmount + (int)$amount;
        
        //Update l'apport
        $queryUpdate = $this->createQueryBuilder('a');
        $q = $queryUpdate->update('App\Entity\Apport', 'a')
        ->set('a.apport', '?1')
        ->andWhere('a.plateforme = ?2')
        ->setParameter(1, $totalAmount)
        ->setParameter(2, $plateforme)
        ->getQuery()
        ->getResult();

        $totalAmount = 0;
    }

    public function transform(Apport $apport)
    {
        return [
                'plateforme' => (string) $apport->getPlateforme(),
                'apport' => (string) $apport->getApport()
        ];
    }

    public function transformAll()
    {
        $apport = $this->findAll();
        $apportArray = [];

        foreach ($apport as $apport) {
            $apportArray[] = $this->transform($apport);
        }

        return $apportArray;
    }
}
