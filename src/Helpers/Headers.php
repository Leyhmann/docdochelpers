<?php

namespace Leyhmann\DocDoc\Helpers;

class Headers
{
    protected $headers = [];

    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
    }

    public function add(string $key, string $value): Headers
    {
        $this->headers[$key] = $value;

        return $this;
    }

    public function remove(string $key): bool
    {
        if (isset($this->headers[$key])) {
            unset($this->headers[$key]);
            return true;
        }
        return false;
    }

    public function set(array $headers): Headers
    {
        $this->headers = $headers;

        return $this;
    }

    public function has(string $key): bool
    {
        return isset($this->headers[$key]);
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}
