<?php

namespace Leyhmann\DocDoc\Helpers\Builders;

use DateTime;

/**
 * Class ClinicsQueryBuilder
 * @package Leyhmann\DocDoc\Helpers\Builders
 */
class ClinicsQueryBuilder extends QueryBuilder
{
    /**
     * {@inheritDoc}
     */
    public const REQUIRED_FIELDS = [
        'start',
        'count',
        'city',
    ];

    /**
     * {@inheritDoc}
     */
    public const TRANSFORMED = ['naDom' => 'na_dom'];

    /**
     * Required
     * @var int
     */
    protected $start = 0;

    /**
     * Required
     * @var int
     */
    protected $count = 500;

    /**
     * Required
     * @var int
     */
    protected $city;

    /**
     * @var int
     */
    protected $clinicType;

    /**
     * Required
     * @var array
     */
    protected $stations = [];

    /**
     * Required
     * @var string("strict", "mixed", "extra")
     */
    protected $nearMode;

    /**
     * @var int(1,2)
     */
    protected $gender;

    /**
     * @var int
     */
    protected $speciality;

    /**
     * @var int
     */
    protected $diagnostic;

    /**
     * @var string|int
     */
    protected $district;

    /**
     * @var int
     */
    protected $street;

    /**
     * @var string("name")
     */
    protected $order;

    /**
     * @var bool
     */
    protected $workAllTime;

    /**
     * @var int
     */
    protected $clinicId;

    /**
     * @var DateTime
     */
    protected $workingTime;

    /**
     * @var bool
     */
    protected $naDom;

    /**
     * @var string("doctor", "diagnostic ")
     */
    protected $kind;

    /**
     * @var bool
     */
    protected $adults;

    /**
     * @var bool
     */
    protected $deti;

    /**
     * @var string
     */
    protected $search;

    /**
     * @param int $start
     * @return ClinicsQueryBuilder
     */
    public function setStart(int $start): ClinicsQueryBuilder
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param int $count
     * @return ClinicsQueryBuilder
     */
    public function setCount(int $count): ClinicsQueryBuilder
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @param int $city
     * @return ClinicsQueryBuilder
     */
    public function setCity(int $city): ClinicsQueryBuilder
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param array $clinicType
     * @return ClinicsQueryBuilder
     */
    public function setClinicType(array $clinicType): ClinicsQueryBuilder
    {
        $this->clinicType = $clinicType;
        return $this;
    }

    /**
     * @param array $stations
     * @return ClinicsQueryBuilder
     */
    public function setStations(array $stations): ClinicsQueryBuilder
    {
        $this->stations = $stations;
        return $this;
    }

    /**
     * @param string $nearMode
     * @return ClinicsQueryBuilder
     */
    public function setNearMode(string $nearMode): ClinicsQueryBuilder
    {
        $this->nearMode = $nearMode;
        return $this;
    }

    /**
     * @param int $speciality
     * @return ClinicsQueryBuilder
     */
    public function setSpeciality(int $speciality): ClinicsQueryBuilder
    {
        $this->speciality = $speciality;
        return $this;
    }

    /**
     * @param int $diagnostic
     * @return ClinicsQueryBuilder
     */
    public function setDiagnostic(int $diagnostic): ClinicsQueryBuilder
    {
        $this->diagnostic = $diagnostic;
        return $this;
    }

    /**
     * @param int|string $district
     * @return ClinicsQueryBuilder
     */
    public function setDistrict($district): ClinicsQueryBuilder
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @param int $street
     * @return ClinicsQueryBuilder
     */
    public function setStreet(int $street): ClinicsQueryBuilder
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param string $order
     * @return ClinicsQueryBuilder
     */
    public function setOrder(string $order): ClinicsQueryBuilder
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param bool $workAllTime
     * @return ClinicsQueryBuilder
     */
    public function setWorkAllTime(bool $workAllTime): ClinicsQueryBuilder
    {
        $this->workAllTime = $workAllTime;
        return $this;
    }

    /**
     * @param int $gender
     * @return ClinicsQueryBuilder
     */
    public function setGender(int $gender): ClinicsQueryBuilder
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param int $clinicId
     * @return ClinicsQueryBuilder
     */
    public function setClinicId(int $clinicId): ClinicsQueryBuilder
    {
        $this->clinicId = $clinicId;
        return $this;
    }

    /**
     * @param DateTime $workingTime
     * @return ClinicsQueryBuilder
     */
    public function setWorkingTime(DateTime $workingTime): ClinicsQueryBuilder
    {
        $this->workingTime = $workingTime;
        return $this;
    }

    /**
     * @param bool $naDom
     * @return ClinicsQueryBuilder
     */
    public function setNaDom(bool $naDom): ClinicsQueryBuilder
    {
        $this->naDom = $naDom;
        return $this;
    }

    /**
     * @param string $kind
     * @return ClinicsQueryBuilder
     */
    public function setKind(string $kind): ClinicsQueryBuilder
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * @param bool $adults
     * @return ClinicsQueryBuilder
     */
    public function setAdults(bool $adults): ClinicsQueryBuilder
    {
        $this->adults = $adults;
        return $this;
    }

    /**
     * @param bool $deti
     * @return ClinicsQueryBuilder
     */
    public function setDeti(bool $deti): ClinicsQueryBuilder
    {
        $this->deti = $deti;
        return $this;
    }

    /**
     * @param string $search
     * @return ClinicsQueryBuilder
     */
    public function setSearch(string $search): ClinicsQueryBuilder
    {
        $this->search = $search;
        return $this;
    }
}
