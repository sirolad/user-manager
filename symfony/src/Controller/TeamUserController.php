<?php

namespace App\Controller;

use App\Service\TeamUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamUserController extends AbstractController
{
    protected $service;

    public function __construct(TeamUser $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/team/user", name="team_user", methods={"GET"})
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TeamUserController.php',
        ]);
    }

    /**
     * @Route("/team/{teamId}/user/{userId}", name="add_team_user", methods={"POST"})
     * @param int $teamId
     * @param int $userId
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(int $teamId, int $userId)
    {
        $this->service->addUserToTeam($teamId, $userId);

        return new JsonResponse([
            'message' => 'successfully added user to Team',
        ], 201);
    }
}
