<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    public function testInbox()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/inbox');
    }

    public function testSend()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/send');
    }

    public function testDraft()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/draft');
    }

}
