<?php

namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Interfaces\ClientInterface;

/**
 * Class AbstractCategory
 * @package Leyhmann\DocDoc\Category
 */
abstract class AbstractCategory
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * AbstractCategory constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $query
     * @param string $key
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    protected function get(string $query, string $key): array
    {
        $this->client->setMethod($query);
        $response = $this->client->getJson();
        if (isset($response[$key])) {
            return $response;
        }
        throw new ResponseError($response['message'] ?? 'Response is error');
    }

    /**
     * @param string $query
     * @param string $key
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    protected function getOnly(string $query, string $key): array
    {
        return $this->get($query, $key)[$key];
    }

    /**
     * @param string $query
     * @param string $key
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    protected function getFirst(string $query, string $key): array
    {
        $response = $this->get($query, $key);
        if (isset($response[$key][0])) {
            return $response[$key][0];
        }
        throw new ResponseError($response['message'] ?? 'Response is error');
    }
}
