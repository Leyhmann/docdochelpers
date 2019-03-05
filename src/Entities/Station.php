<?php

namespace Leyhmann\DocDoc\Entities;

/**
 * DTO class station
 * Class Station
 * @package Leyhmann\DocDoc\Entities
 */
class Station extends Entity
{
    /**
     * {@inheritdoc}
     * @var array
     */
    protected const TYPES = [
        'Id' => 'integer',
        'CityId' => 'integer',
        'DistrictIds' => 'array',
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
    protected $LineName;

    /**
     * @var string
     */
    protected $LineColor;

    /**
     * @var int
     */
    protected $CityId;

    /**
     * @var string
     */
    protected $Alias;

    /**
     * @var array
     */
    protected $DistrictIds = [];

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
    public function getLineName(): string
    {
        return $this->LineName;
    }

    /**
     * @return string
     */
    public function getLineColor(): string
    {
        return $this->LineColor;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->CityId;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->Alias;
    }

    /**
     * @return array
     */
    public function getDistrictIds(): array
    {
        return $this->DistrictIds;
    }
}
