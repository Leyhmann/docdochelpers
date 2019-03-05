<?php

namespace Leyhmann\DocDoc\Tests\Services;

use Leyhmann\DocDoc\Helpers\Builders\RequestQueryBuilder;
use Leyhmann\DocDoc\Services\Request;

class RequestTest extends AbstractCategoryTest
{
    /**
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     * @throws \Exception
     */
    public function testSend(): void
    {
        $request = new Request($this->client);
        $response = $request->send(
            (new RequestQueryBuilder)
            ->setCity(1)
            ->setName('text')
            ->setPhone('7' . \random_int(1000000000, 9999999999))
        );
        $this->assertArrayHasKey('status', $response);
        $this->assertEquals('success', $response['status']);
    }
}
