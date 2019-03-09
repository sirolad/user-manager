<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\ConstraintViolationList;

class AdminController extends AbstractController
{
    protected $service;

    public function __construct(\App\Service\User $service)
    {
        $this->service = $service;
    }

    /**
     * @Route("/admin", name="admin", methods={"GET"})
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AdminController.php',
        ]);
    }

    /**
     * @Route("/admin", name="add_user", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(Request $request)
    {
        $user = $this->service->addUser($request);

        if ($user instanceof ConstraintViolationList) {
            return new JsonResponse(['error' => (string) $user], 403);
        }

        return new JsonResponse([
            'message' => 'successfully added user',
        ], 201);
    }

    /**
     * @Route("/admin/{id}", name="delete_user", methods={"DELETE"})
     * @param $id
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($id)
    {
        $deleted = $this->service->deleteUser($id);
        if ($deleted) {
            return new JsonResponse([
                'message' => 'successfully deleted user',
            ], 204);
        }

        return new JsonResponse(['error' => 'User does not Exist'], 404);
    }
}
