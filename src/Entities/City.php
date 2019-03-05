<?php

namespace Leyhmann\DocDoc\Entities;

/**
 * DTO class
 * Class City
 * @package Leyhmann\DocDoc\Entities
 */
class City extends Entity
{
    protected const TYPES = [
        'Id' => 'int',
        'HasDiagnostic' => 'bool',
        'SearchType' => 'int',
        'TimeZone' => 'int',
        'Latitude' => 'float',
        'Longitude' => 'float',
    ];

    /**
     * @var int
     */
    protected $Id;

    /**
     * @var string
     */
    protected $Name;

    /**
     * @var string
     */
    protected $Alias;

    /**
     * @var string
     */
    protected $Phone;

    /**
     * @var float
     */
    protected $Latitude;

    /**
     * @var float
     */
    protected $Longitude;

    /**
     * @var integer(1,2,3)
     */
    protected $SearchType;

    /**
     * @var bool
     */
    protected $HasDiagnostic;

    /**
     * @var integer
     */
    protected $TimeZone;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->Id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->Alias;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->Phone;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->Latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->Longitude;
    }

    /**
     * @return int
     */
    public function getSearchType(): int
    {
        return $this->SearchType;
    }

    /**
     * @return bool
     */
    public function isHasDiagnostic(): bool
    {
        return $this->HasDiagnostic;
    }

    /**
     * @return int
     */
    public function getTimeZone(): int
    {
        return $this->TimeZone;
    }
}
