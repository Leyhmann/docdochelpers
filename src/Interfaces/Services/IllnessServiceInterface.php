<?php


namespace Leyhmann\DocDoc\Interfaces\Services;

/**
 * Interface IllnessServiceInterface
 * @package Leyhmann\DocDoc\Interfaces\Services
 */
interface IllnessServiceInterface
{
    /**
     * Detailed disease information
     *
     * @inheritDoc
     * @return array
     */
    public function info(int $id): array;
}
