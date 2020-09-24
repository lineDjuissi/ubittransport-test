<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StudentTest extends WebTestCase
{
    public function testPageIsSuccessFull()
    {
        $client = static::createClient();

        $client->request('GET', '/api/students');

        $this->assertResponseStatusCodeSame(200);
    }
}