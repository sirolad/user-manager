<?php
/**
 * Created by PhpStorm.
 * User: sirolad
 * Date: 2019-03-09
 * Time: 19:56
 */

namespace App\Service;

use App\Entity\UserTeam;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use App\Repository\UserTeamRepository;

class TeamUser
{
    protected $userRepository;

    protected $teamRepository;

    protected $userTeamRepository;

    public function __construct(
        UserTeamRepository $userTeamRepository,
        UserRepository $userRepository,
        TeamRepository $teamRepository
    )
    {
        $this->userTeamRepository = $userTeamRepository;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param $teamId
     * @param $userId
     * @return string
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUserToTeam($teamId, $userId)
    {
        $teamUser = new UserTeam();
        $team = $this->teamRepository->find($teamId);
        $user = $this->userRepository->find($userId);
        if (!$team) {
            return "Team Does Not Exist";
        }

        if (!$user) {
            return "User Does Not Exist";
        }
        $teamUser->setTeam($team);
        $teamUser->setUser($user);
        $this->userTeamRepository->save($teamUser);

        return true;
    }

    protected function findUserByTeam($team, $userId)
    {

        $this->teamRepository->findBy([])
    }
}