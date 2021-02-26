<?php
namespace App\Controller;

use App\Entity\Apport;
use App\Repository\ApportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ApportController extends ApiController
{
    /**
    * @Route("/apport", methods="GET")
    */
    public function index(ApportRepository $apportRepository)
    {
        $apport = $apportRepository->transformAll();

        return $this->respond($apport);
    }

    /**
    * @Route("/apport", methods="POST")
    */
    public function create(Request $request, ApportRepository $apportRepository, EntityManagerInterface $em)
    {
        $parameters = json_decode($request->getContent(), true);
        $apportRepository->updateApportByPlateforme($parameters['plateforme'], $parameters['apport']);

        return $this->respondCreated();
    }
}