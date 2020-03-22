<?php

namespace Leyhmann\DocDoc\Interfaces;

use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Leyhmann\DocDoc\Helpers\Headers;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ClientInterface
 * @package Leyhmann\DocDoc\Interfaces
 */
interface ClientInterface
{
    /**
     * @param string $method
     * @return ClientInterface
     */
    public function setMethod(string $method): ClientInterface;

    /**
     * @param Headers|null $headers
     * @throws MethodIsNotSet
     * @throws Unauthorized
     * @return ResponseInterface
     */
    public function get(Headers $headers = null): ResponseInterface;

    /**
     * @param Headers|null $headers
     * @param string|null $body
     * @throws MethodIsNotSet
     * @throws Unauthorized
     * @return ResponseInterface
     */
    public function post(Headers $headers = null, ?string $body = ''): ResponseInterface;

    /**
     * @return array
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getJson(): array;
}
