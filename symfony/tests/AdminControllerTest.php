<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testStoreUser()
    {
        $client = static::createClient();
        $client->request('POST', '/admin', ['username' => 'tester', 'role' => 'user', 'password' => 'mall']);

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testDeleteUser()
    {
        $client = static::createClient();
        $client->request('DELETE', '/admin/1');

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }
}