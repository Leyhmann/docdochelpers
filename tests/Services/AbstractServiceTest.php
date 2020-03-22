<?php

namespace Leyhmann\DocDoc\Tests\Services;

use Leyhmann\DocDoc\Client;
use PHPUnit\Framework\TestCase;
use function getenv;

abstract class AbstractServiceTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp(): void
    {
        $this->client = new Client(
            getenv('DOCDOC_LOGIN'),
            getenv('DOCDOC_PASSWORD'),
            getenv('DOCDOC_API')
        );
    }
}
