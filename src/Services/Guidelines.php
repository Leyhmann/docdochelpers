<?php

namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\ResponseError;

/**
 * Class Guidelines
 * @package Leyhmann\DocDoc\Services
 */
class Guidelines extends AbstractCategory
{
    /**
     * Get recommendations before taking
     *
     * @param int|null $sector
     * @param int|null $service
     * @param int|null $diagnostic
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getGuidelines(int $sector = null, int $service = null, int $diagnostic = null): array
    {
        return $this->getOnly('guidelines/?' . \http_build_query([
                'sector' => $sector,
                'service' => $service,
                'diagnostic' => $diagnostic,
            ]), 'Guidelines');
    }
}
