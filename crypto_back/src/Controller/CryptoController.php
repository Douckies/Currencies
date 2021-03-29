<?php
namespace App\Controller;

use App\Entity\Crypto;
use App\Repository\CryptoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class CryptoController extends ApiController
{
    /**
    * @Route("/geckoCoins", methods="GET")
    */
    public function getGeckoCoinsAPI(CryptoRepository $cryptoRepository, EntityManagerInterface $em)
    {
        //Fetch all the crypto currancies in the database.
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=250&page=1&sparkline=false
        ');
        $response2 = $client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=250&page=2&sparkline=false
        ');
        $response3 = $client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=250&page=3&sparkline=false
        ');
        $response4 = $client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=250&page=4&sparkline=false
        ');
        $response5 = $client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=250&page=5&sparkline=false
        ');

        $content = json_decode($response->getContent(), true);
        $content2 = json_decode($response2->getContent(), true);
        $content3 = json_decode($response3->getContent(), true);
        $content4 = json_decode($response4->getContent(), true);
        $content5 = json_decode($response5->getContent(), true);
        
        for($i = 0; $i < count($content); $i ++) {

            $currencyExists = $cryptoRepository->checkIfAlreadyExists($content[$i]['symbol'], 'NULL');
            $currencyExists2 = $cryptoRepository->checkIfAlreadyExists($content2[$i]['symbol'], 'NULL');
            $currencyExists3 = $cryptoRepository->checkIfAlreadyExists($content3[$i]['symbol'], 'NULL');
            $currencyExists4 = $cryptoRepository->checkIfAlreadyExists($content4[$i]['symbol'], 'NULL');
            $currencyExists5 = $cryptoRepository->checkIfAlreadyExists($content5[$i]['symbol'], 'NULL');

            if($currencyExists) {
                $cryptoRepository->updateCurrencyWithGeckoCoinsInformations(
                    $content[$i]['symbol'], 
                    $content[$i]['current_price'], 
                    $content[$i]['market_cap'],
                    $content[$i]['image']
                );
            }
            if($currencyExists2) {
                $cryptoRepository->updateCurrencyWithGeckoCoinsInformations(
                    $content2[$i]['symbol'], 
                    $content2[$i]['current_price'], 
                    $content2[$i]['market_cap'],
                    $content2[$i]['image']
                );
            }
            if($currencyExists3) {
                $cryptoRepository->updateCurrencyWithGeckoCoinsInformations(
                    $content3[$i]['symbol'], 
                    $content3[$i]['current_price'], 
                    $content3[$i]['market_cap'],
                    $content3[$i]['image']
                );
            }
            if($currencyExists4) {
                $cryptoRepository->updateCurrencyWithGeckoCoinsInformations(
                    $content4[$i]['symbol'], 
                    $content4[$i]['current_price'], 
                    $content4[$i]['market_cap'],
                    $content4[$i]['image']
                );
            }
            if($currencyExists5) {
                $cryptoRepository->updateCurrencyWithGeckoCoinsInformations(
                    $content5[$i]['symbol'], 
                    $content5[$i]['current_price'], 
                    $content5[$i]['market_cap'],
                    $content5[$i]['image']
                );
            }
        }

        $em->flush();

        return $this->respondCreated();
    }

    /**
    * @Route("/cryptos", methods="GET")
    */
    public function index(CryptoRepository $cryptoRepository)
    {
        //Fetch all the crypto currancies in the database.
        $cryptos = $cryptoRepository->findAll();

        //Serialize the array in JSON to return.
        return new Response($this->serializer->serialize($cryptos, 'json'),
            Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
    * @Route("/crypto/orderCurrency", methods="POST")
    */
    public function orderCurrency(Request $request, CryptoRepository $cryptoRepository, EntityManagerInterface $em)
    {
        $parameters = json_decode($request->getContent(), true);

        //Check if the new currency already exists
        $alreadyExists = $cryptoRepository->checkIfAlreadyExists($parameters['currencyToBuy'], $parameters['exchange']);
            
        //Sell the currency if there is a currency to sell
        if(array_key_exists('currencyToSell', $parameters)) {
            $cryptoRepository->sellCurrency($parameters['currencyToSell'], $parameters['exchange'], $parameters['quantityToSell']);
        }

        //If already exists, update the database, otherwise create the entry
        if($alreadyExists) {
            $cryptoRepository->buyCurrency($parameters['currencyToBuy'], $parameters['exchange'], $parameters['quantityToBuy'], $parameters['investment']);
        } else {
            $crypto = new Crypto;
            $crypto->setPlateforme($parameters['exchange']);
            $crypto->setNom($parameters['currencyToBuy']);
            $crypto->setQtt($parameters['quantityToBuy']);
            $crypto->setInvestissement(0); 

            if ($parameters['currencyToBuy'] === 'USD' || $parameters['currencyToSell'] === 'USD') {
                $crypto->setInvestissement($parameters['investment']);
            }

            $em->persist($crypto);
        }

        $em->flush();

        return $this->respondCreated();
    }
}