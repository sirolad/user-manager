<?php

namespace App\Service;

use App\Repository\TeamRepository;
use App\Repository\UserTeamRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Team
{
    protected $validator;

    protected $teamRepository;

    protected $userTeamRepository;

    public function __construct(
        ValidatorInterface $validator,
        TeamRepository $teamRepository,
        UserTeamRepository $userTeamRepository
    )
    {
        $this->validator = $validator;
        $this->teamRepository = $teamRepository;
        $this->userTeamRepository = $userTeamRepository;
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

        $this->teamRepository->save($team);

        return true;
    }

    /**
     * @param $id
     * @return bool|string
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteTeam($id)
    {
        $teamHasMembers = $this->userTeamRepository->findTeamMembers($id);

        if ($teamHasMembers) {
            return "Cannot delete a team that has members";
        }

        $team = $this->teamRepository->find($id);
        if ($team) {
            $this->teamRepository->delete($team);

            return true;
        }
    }
}