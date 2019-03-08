<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoleFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $roles = ['admin', 'user'];

         foreach ($roles as $value) {
             $role = new Role();
             $role->setRole($value);
             $manager->persist($role);
         }

        $manager->flush();
    }
}
