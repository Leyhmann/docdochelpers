<?php

namespace Leyhmann\DocDoc\Helpers;

/**
 * Class Headers
 * @package Leyhmann\DocDoc\Helpers
 */
class Headers
{
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * Headers constructor.
     * @param array $headers
     */
    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
    }

    /**
     * @param string $key
     * @param string $value
     * @return Headers
     */
    public function add(string $key, string $value): Headers
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function remove(string $key): bool
    {
        if (isset($this->headers[$key])) {
            unset($this->headers[$key]);
            return true;
        }
        return false;
    }

    /**
     * @param array $headers
     * @return Headers
     */
    public function set(array $headers): Headers
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this->headers[$key]);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->headers;
    }
}
