<?php


namespace Leyhmann\DocDoc\Interfaces\Helpers;

use Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet;

/**
 * Interface QueryBuilderInterface
 * @package Leyhmann\DocDoc\Interfaces\Helpers
 */
interface QueryBuilderInterface
{
    /**
     * @return string
     * @throws RequiredFieldIsNotSet
     */
    public function getQueryString(): string;
}
