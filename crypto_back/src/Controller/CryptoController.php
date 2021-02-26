<?php
namespace App\Controller;

use App\Entity\Crypto;
use App\Repository\CryptoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class CryptoController extends ApiController
{
    /**
    * @Route("/crypto", methods="GET")
    */
    public function index(CryptoRepository $cryptoRepository)
    {
        $crypto = $cryptoRepository->transformAll();

        return $this->respond($crypto);
    }

     /**
    * @Route("/crypto", methods="POST")
    */
    public function create(Request $request, CryptoRepository $cryptoRepository, EntityManagerInterface $em)
    {
        $parameters = json_decode($request->getContent(), true);
        //dd($parameters);
        //$request = $this->transformJsonBody($request);
        $crypto = new Crypto;
        $crypto->setPlateforme($parameters['plateforme']);
        $crypto->setNom($parameters['nom']);
        $crypto->setQtt($parameters['qtt']);
        $crypto->setInvestissement($parameters['investissement']);

        $em->persist($crypto);
        $em->flush();

        return $this->respondCreated($cryptoRepository->transform($crypto));
    }
}