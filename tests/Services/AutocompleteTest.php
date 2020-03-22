<?php

namespace Leyhmann\DocDoc\Tests\Services;

use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Leyhmann\DocDoc\Services\ServicesService;

class AutocompleteTest extends AbstractServiceTest
{
    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testAutocomplete(): void
    {
        $autocomplete = new ServicesService($this->client);
        $result = $autocomplete->autocomplete(1, 'Аллерг');
        $this->assertArrayHasKey('Value', $result[0]);
        $this->assertArrayHasKey('Type', $result[0]);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('Url', $result[0]);
    }
}
