<?php
namespace App\Controller;

use App\Entity\Apport;
use App\Repository\ApportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ApportController extends ApiController
{
    /**
    * @Route("/apport", methods="GET")
    */
    public function index(ApportRepository $apportRepository)
    {
        $apport = $apportRepository->findAll();

        //Serialize the array in JSON to return.
        return new Response($this->serializer->serialize($apport, 'json'),
        Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    /**
    * @Route("/apport", methods="POST")
    */
    public function create(Request $request, ApportRepository $apportRepository, EntityManagerInterface $em)
    {
        $parameters = json_decode($request->getContent(), true);

        $apportRepository->updateApportByExchange($parameters['exchange'], $parameters['apport']);

        $em->flush();

        return $this->respondCreated();
    }
}