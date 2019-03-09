<?php

namespace App\Controller;

use App\Service\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolationList;

class TeamController extends AbstractController
{
    protected $service;

    public function __construct(Team $service)
    {
        $this->service = $service;
    }
    /**
     * @Route("/team", name="team", methods={"GET"})
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TeamController.php',
        ]);
    }

    /**
     * @Route("/team", name="add_team", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Request $request)
    {
        $team = $this->service->addTeam($request);

        if ($team instanceof ConstraintViolationList) {
            return new JsonResponse(['error' => (string) $team], 403);
        }

        return new JsonResponse([
            'message' => 'successfully added team',
        ], 201);
    }
}
