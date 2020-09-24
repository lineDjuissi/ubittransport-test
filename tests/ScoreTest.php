<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ScoreTest extends WebTestCase
{
    public function testPageIsSuccessFull()
    {
        $client = static::createClient();

        $client->request('GET', '/api/scores/average');

        $this->assertResponseStatusCodeSame(200);
    }
}