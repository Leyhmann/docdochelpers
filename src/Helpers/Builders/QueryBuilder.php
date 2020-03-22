<?php

namespace Leyhmann\DocDoc\Helpers\Builders;

use DateTime;
use Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet;
use Leyhmann\DocDoc\Interfaces\Helpers\QueryBuilderInterface;
use function http_build_query;
use function implode;
use function in_array;
use function is_array;

/**
 * Query helper for long api
 *
 * Class QueryBuilder
 * @package Leyhmann\DocDoc\Helpers
 */
abstract class QueryBuilder implements QueryBuilderInterface
{
    /**
     * List of required fields
     */
    public const REQUIRED_FIELDS = [];

    /**
     * List of fields to rename
     */
    public const TRANSFORMED = [];

    /**
     * List of fields that cannot be used as a get parameter
     */
    public const GET_NOT_ALLOWED = [];

    /**
     * @return QueryBuilder
     */
    public static function create(): QueryBuilder
    {
        return new static();
    }

    /**
     * @return string
     * @throws RequiredFieldIsNotSet
     */
    public function getQueryString(): string
    {
        $queryString = '';
        foreach (static::GET_NOT_ALLOWED as $key) {
            if (!empty($this->$key)) {
                $queryString .= "{$key}/{$this->$key}/";
            }
        }
        return $queryString . '?' . http_build_query($this->getQuery());
    }

    /**
     * @return array
     * @throws RequiredFieldIsNotSet
     */
    public function getQuery(): array
    {
        $query = [];
        foreach ($this as $key => $value) {
            $this->checkRequired($key, $value);
            if (!empty($value) && !in_array($key, static::GET_NOT_ALLOWED, true)) {
                if (is_array($value)) {
                    $query[$key] = implode(',', $value);
                } elseif (is_object($value) && get_class($value) === DateTime::class) {
                    $query[$key] = $value->format('Y-m-d H:i:s');
                } else {
                    if (in_array($key, static::TRANSFORMED, true)) {
                        $key = static::TRANSFORMED[$key];
                    }
                    if ($value === true) {
                        $value = 1;
                    } elseif ($value === false) {
                        $value = 0;
                    }
                    $query[$key] = $value;
                }
            }
        }
        return $query;
    }

    /**
     * @param $key
     * @param $value
     * @throws RequiredFieldIsNotSet
     */
    protected function checkRequired($key, $value): void
    {
        if (($value === null || $value === []) && in_array($key, static::REQUIRED_FIELDS, true)) {
            throw new RequiredFieldIsNotSet("The field {$key} is required");
        }
    }
}
