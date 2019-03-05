<?php

namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\ResponseError;

/**
 * Class Autocomplete
 * @package Leyhmann\DocDoc\Services
 */
class Autocomplete extends AbstractCategory
{
    /**
     * @param int $cityId
     * @param string $search
     * @param bool $withoutClinics
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function autocomplete(int $cityId, string $search, bool $withoutClinics = true): array
    {
        $without = (int)$withoutClinics;
        return $this->getOnly(
            "autocomplete/city/{$cityId}/withoutClinics/{$without}?search={$search}",
            'Suggestions'
        );
    }
}
