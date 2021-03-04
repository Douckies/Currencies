<?php
namespace App\Controller;

use App\Entity\History;
use App\Repository\HistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class HistoryController extends ApiController
{
    /**
    * @Route("/history", methods="GET")
    */
    public function index(HistoryRepository $historyRepository)
    {
        //Fetch all the crypto currancies in the database.
        $history = $historyRepository->findAll();

        //Serialize the array in JSON to return.
        return new Response($this->serializer->serialize($history, 'json'),
            Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
    * @Route("/crypto/history", methods="POST")
    */
    public function newCurrency(Request $request, HistoryRepository $historyRepository, EntityManagerInterface $em)
    {
        $parameters = json_decode($request->getContent(), true);
        $time = date("d-m-Y, H:i:s");

        $history = new History;
        $history->setDate($time);
        $history->setExchange($parameters['exchange']);
        $history->setBoughtCurrency($parameters['currencyToBuy']);
        $history->setBoughtCurrencyQtt($parameters['quantityToBuy']);
        $history->setSoldCurrency($parameters['currencyToSell']);
        $history->setSoldCurrencyQtt($parameters['quantityToSell']);
        $history->setOperation($parameters['operation']);

        $em->persist($history);          
        $em->flush();

        return $this->respondCreated();
    }
}