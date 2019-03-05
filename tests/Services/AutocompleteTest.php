<?php

namespace Leyhmann\DocDoc\Tests\Services;

use Leyhmann\DocDoc\Services\Autocomplete;

class AutocompleteTest extends AbstractCategoryTest
{
    /**
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testAutocomplete(): void
    {
        $autocomplete = new Autocomplete($this->client);
        $result = $autocomplete->autocomplete(1, 'Аллерг');
        $this->assertArrayHasKey('Value', $result[0]);
        $this->assertArrayHasKey('Type', $result[0]);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('Url', $result[0]);
    }
}
