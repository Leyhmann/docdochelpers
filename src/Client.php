<?php

namespace Leyhmann\DocDoc;

use Buzz\Browser;
use Buzz\Client\FileGetContents;
use Buzz\Middleware\BasicAuthMiddleware;
use Leyhmann\DocDoc\Helpers\Headers;
use Leyhmann\DocDoc\Interfaces\ClientInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Psr\Http\Message\ResponseInterface;
use function json_decode;

/**
 * Class Client
 * @package Leyhmann\DocDoc
 */
class Client implements ClientInterface
{
    /**
     * @var Browser
     */
    protected $browser;

    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var string
     */
    protected $method;

    /**
     * Client constructor.
     * @param string $username
     * @param string $password
     * @param string $apiUrl
     */
    public function __construct(string $username, string $password, string $apiUrl = 'https://api.docdoc.ru/public/rest/1.0.12/json/')
    {
        $client = new FileGetContents();
        $this->browser = new Browser($client, new Psr17Factory());
        $auth = new BasicAuthMiddleware($username, $password);
        $this->browser->addMiddleware($auth);
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param string $method
     * @return Client
     */
    public function setMethod(string $method): ClientInterface
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @param Headers|null $headers
     * @return ResponseInterface
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function get(Headers $headers = null): ResponseInterface
    {
        $headersArr = $headers ? $headers->toArray() : [];
        return $this->handleResponse($this->browser->get($this->getRequestUrl(), $headersArr));
    }

    /**
     * @param Headers|null $headers
     * @param string|null $body
     * @return ResponseInterface
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function post(Headers $headers = null, ?string $body = ''): ResponseInterface
    {
        $headersArr = $headers ? $headers->toArray() : [];
        return $this->handleResponse($this->browser->post($this->getRequestUrl(), $headersArr, $body));
    }

    /**
     * @return array
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getJson(): array
    {
        return json_decode($this->get()->getBody()->getContents(), true);
    }

    /**
     * @return string
     * @throws MethodIsNotSet
     */
    protected function getRequestUrl(): string
    {
        if ($this->method === null) {
            throw new MethodIsNotSet('It is necessary to establish a method for accessing api');
        }
        return $this->apiUrl . $this->method;
    }

    /**
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws Unauthorized
     */
    protected function handleResponse(ResponseInterface $response): ResponseInterface
    {
        switch ($response->getStatusCode()) {
            case 401:
                throw new Unauthorized($response->getReasonPhrase());
            case 200:
            default:
                return $response;
        }
    }
}
