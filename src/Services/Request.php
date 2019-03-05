<?php

namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Helpers\Headers;
use Leyhmann\DocDoc\Helpers\Builders\RequestQueryBuilder;

/**
 * Class Request
 * @package Leyhmann\DocDoc\Services
 */
class Request extends AbstractCategory
{
    /**
     * @param RequestQueryBuilder $queryBuilder
     * @return array ["status" => "success|error", "message" => "*"]
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function send(RequestQueryBuilder $queryBuilder): array
    {
        $this->client->setMethod('request');
        $response = \json_decode($this->client->post(
            new Headers(['Content-Type' => 'application/json']),
            \json_encode($queryBuilder->getQuery())
        )->getBody()->getContents(), true);
        if (isset($response['Response'])) {
            return $response['Response'];
        }
        throw new ResponseError($response['message'] ?? 'Response is error');
    }
}
