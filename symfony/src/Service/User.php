<?php

namespace App\Service;

use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class User
{
    protected $roleRepository;

    protected $validator;

    protected $userRepository;

    public function __construct(
        RoleRepository $roleRepository,
        ValidatorInterface $validator,
        UserRepository $userRepository
        )
    {
        $this->roleRepository = $roleRepository;
        $this->validator = $validator;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return bool|\Symfony\Component\Validator\ConstraintViolationListInterface
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(Request $request)
    {
        $user = new \App\Entity\User();
        $user->setUsername($request->get('username'));
        $user->setPassword($request->get('password'));
        $role = $this->roleRepository->findOneBy(['role' => $request->get('role')]);
        $user->setRole($role);
        $errors = $this->validator->validate($user);
        if ($errors->count()) {
            return $errors;
        }

        $this->userRepository->save($user);

        return true;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteUser(int $id)
    {
        $user = $this->userRepository->find($id);
        if ($user) {
            $this->userRepository->delete($user);

            return true;
        }
    }
}