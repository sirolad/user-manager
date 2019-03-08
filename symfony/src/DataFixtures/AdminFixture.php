<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AdminFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $role = $manager->getRepository(Role::class)->find(1);
        $admin = new User();
        $admin->setName('Admin');
        $admin->setRole($role);
        $manager->persist($admin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RoleFixture::class
        ];
    }
}
