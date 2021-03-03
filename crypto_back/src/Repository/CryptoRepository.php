<?php

namespace App\Repository;

use App\Entity\Crypto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Crypto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Crypto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Crypto[]    findAll()
 * @method Crypto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CryptoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Crypto::class);
    }

    //Function to check if a crypto currancy already exist in an exchange
    public function checkIfAlreadyExists($cryptoToTest, $plateforme)
    {
        $querySelect = $this->createQueryBuilder('q');
        $alreadyExists = $querySelect
            ->select('q.nom')
            ->andWhere('q.nom = ?1')
            ->andWhere('q.plateforme = ?2')
            ->setParameter(1, $cryptoToTest)
            ->setParameter(2, $plateforme)
            ->getQuery()
            ->getResult();
        
        return $alreadyExists;
    }

    public function buyCurrency($currency, $exchange, $quantityBought, $investment) {
        //Find the currencies on the database
        $currencyToBuy = $this->findByNom($currency);

        //Filter with the required exchange
        for ($i = 0; $i <= count($currencyToBuy) - 1; $i++) {
            $exchangeToVerify = $currencyToBuy[$i]->getPlateforme();

            //If it is the required exchange, update the values
            if($exchangeToVerify === $exchange) {
                $currencyToBuy[$i]->setInvestissement((int)$currencyToBuy[$i]->getInvestissement() + $investment);
                $currencyToBuy[$i]->setQtt((int)$currencyToBuy[$i]->getQtt() + $quantityBought);
            }
        }
    }

    public function sellCurrency($currency, $exchange, $quantitySold) {
        //Find the currencies on the database
        $currencyToSell = $this->findByNom($currency);

        //Filter with the required exchange
        for ($i = 0; $i <= count($currencyToSell) - 1; $i++) {
            $exchangeToVerify = $currencyToSell[$i]->getPlateforme();

            //If it is the required exchange, update the values
            if($exchangeToVerify === $exchange) {
                $currencyToSell[$i]->setQtt((int)$currencyToSell[$i]->getQtt() - $quantitySold);
            }
        }
    }
}
