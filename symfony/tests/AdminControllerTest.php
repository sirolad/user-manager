<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testStoreUser()
    {
        $client = static::createClient();
        $client->request('POST', '/admin', ['username' => 'tester', 'role' => 'user']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}