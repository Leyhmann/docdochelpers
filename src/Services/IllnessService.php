<?php


namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Interfaces\Services\IllnessServiceInterface;

/**
 * Class IllnessService
 * @package Leyhmann\DocDoc\Services
 */
class IllnessService extends AbstractService implements IllnessServiceInterface
{
    /**
     * @param int $id
     * @return array
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function info(int $id): array
    {
        return $this->get("illness/{$id}", 'Id');
    }
}
