<?php

namespace App\Service;

use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Team
{
    protected $validator;

    protected $teamRepository;

    public function __construct(ValidatorInterface $validator, TeamRepository $teamRepository)
    {
        $this->validator = $validator;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param Request $request
     * @return bool|\Symfony\Component\Validator\ConstraintViolationListInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addTeam(Request $request)
    {
        $team = new \App\Entity\Team();
        $team->setName($request->get('name'));
        $errors = $this->validator->validate($team);
        if ($errors->count()) {
            return $errors;
        }
        var_dump('crossed');
        $this->teamRepository->save($team);

        return true;
    }
}