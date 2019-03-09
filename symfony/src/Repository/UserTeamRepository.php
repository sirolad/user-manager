<?php

namespace App\Repository;

use App\Entity\UserTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserTeam|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTeam|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTeam[]    findAll()
 * @method UserTeam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTeamRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserTeam::class);
    }

    /**
     * @param UserTeam $user
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(UserTeam $user)
    {
        // _em is EntityManager which is DI by the base class
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param $userTeam
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($userTeam)
    {
        $this->_em->remove($userTeam);
        $this->_em->flush();
    }
}
