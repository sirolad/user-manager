<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testStoreUser()
    {
        $client = static::createClient();
        $client->request('POST', '/team', ['name' => 'tester team']);

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testDeleteTeam()
    {
        $client = static::createClient();
        $client->request('DELETE', '/team/1');

        $this->assertEquals(204, $client->getResponse()->getStatusCode());
    }
}