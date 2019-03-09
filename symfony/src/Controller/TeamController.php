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

    /**
     * @Route("/team/{id}", name="delete_team", methods={"DELETE"})
     * @param $id
     * @return JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($id)
    {
        $deleted = $this->service->deleteTeam($id);

        if (gettype($deleted) == 'string') {
            return new JsonResponse(['error' => (string) $deleted], 403);
        }
        if ($deleted) {
            return new JsonResponse([
                'message' => 'successfully deleted team',
            ], 204);
        }

        return new JsonResponse(['error' => $deleted], 404);
    }
}
