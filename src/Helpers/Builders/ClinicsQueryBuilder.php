<?php

namespace Leyhmann\DocDoc\Helpers\Builders;

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
     * @var array(1,2,3)
     */
    protected $clinicType = [];

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
}
