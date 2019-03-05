<?php

namespace Leyhmann\DocDoc\Helpers\Builders;

/**
 * Helper for query doctor
 *
 * Class DoctorsQueryBuilder
 * @package Leyhmann\DocDoc\Helpers
 */
class DoctorsQueryBuilder extends QueryBuilder
{
    /**
     * {@inheritDoc}
     */
    public const REQUIRED_FIELDS = [
        'start',
        'count',
        'city',
        'stations',
        'near',
    ];

    /**
     * {@inheritDoc}
     */
    public const GET_NOT_ALLOWED = ['order'];

    /**
     * {@inheritDoc}
     */
    public const TRANSFORMED = ['naDom' => 'na-dom'];

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
    protected $speciality;

    /**
     * @var int
     */
    protected $areaID;

    /**
     * @var int
     */
    protected $districtID;

    /**
     * Required
     * @var array
     */
    protected $stations = [];

    /**
     * Required
     * @var string("strict", "mixed", "extra")
     */
    protected $near = 'strict';

    /**
     * @var string("price", "experience", "rating", "distance", "name")
     */
    protected $order;

    /**
     * @var bool
     */
    protected $deti;

    /**
     * @var bool
     */
    protected $naDom;

    /**
     * @var string("landing")
     */
    protected $type;

    /**
     * @var int
     */
    protected $lat;

    /**
     * @var int
     */
    protected $lng;

    /**
     * @var int
     */
    protected $radius;

    /**
     * @var int
     */
    protected $street;

    /**
     * @var bool
     */
    protected $withSlots;

    /**
     * @var int
     */
    protected $slotsDays;

    /**
     * if male = 1, if female = 2
     * @var int(1,2)
     */
    protected $gender;

    /**
     * @var bool
     */
    protected $withReviews;

    /**
     * @var bool
     */
    protected $splitClinic;

    /**
     * @var string
     */
    protected $illness;

    /**
     * @param int $start
     * @return DoctorsQueryBuilder
     */
    public function setStart(int $start): DoctorsQueryBuilder
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param int $count
     * @return DoctorsQueryBuilder
     */
    public function setCount(int $count): DoctorsQueryBuilder
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @param int $city
     * @return DoctorsQueryBuilder
     */
    public function setCity(int $city): DoctorsQueryBuilder
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param int $speciality
     * @return DoctorsQueryBuilder
     */
    public function setSpeciality(int $speciality): DoctorsQueryBuilder
    {
        $this->speciality = $speciality;
        return $this;
    }

    /**
     * @param int $areaID
     * @return DoctorsQueryBuilder
     */
    public function setAreaID(int $areaID): DoctorsQueryBuilder
    {
        $this->areaID = $areaID;
        return $this;
    }

    /**
     * @param int $districtID
     * @return DoctorsQueryBuilder
     */
    public function setDistrictID(int $districtID): DoctorsQueryBuilder
    {
        $this->districtID = $districtID;
        return $this;
    }

    /**
     * @param array $stations
     * @return DoctorsQueryBuilder
     */
    public function setStations(array $stations): DoctorsQueryBuilder
    {
        $this->stations = $stations;
        return $this;
    }

    /**
     * @param string $near
     * @return DoctorsQueryBuilder
     */
    public function setNearMode(string $near): DoctorsQueryBuilder
    {
        $this->near = $near;
        return $this;
    }

    /**
     * @param string $order
     * @return DoctorsQueryBuilder
     */
    public function setOrder(string $order): DoctorsQueryBuilder
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param bool $deti
     * @return DoctorsQueryBuilder
     */
    public function setDeti(bool $deti): DoctorsQueryBuilder
    {
        $this->deti = $deti;
        return $this;
    }

    /**
     * @param bool $naDom
     * @return DoctorsQueryBuilder
     */
    public function setNaDom(bool $naDom): DoctorsQueryBuilder
    {
        $this->naDom = $naDom;
        return $this;
    }

    /**
     * @param string $type
     * @return DoctorsQueryBuilder
     */
    public function setType(string $type): DoctorsQueryBuilder
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param int $lat
     * @return DoctorsQueryBuilder
     */
    public function setLat(int $lat): DoctorsQueryBuilder
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @param int $lng
     * @return DoctorsQueryBuilder
     */
    public function setLng(int $lng): DoctorsQueryBuilder
    {
        $this->lng = $lng;
        return $this;
    }

    /**
     * @param int $radius
     * @return DoctorsQueryBuilder
     */
    public function setRadius(int $radius): DoctorsQueryBuilder
    {
        $this->radius = $radius;
        return $this;
    }

    /**
     * @param int $street
     * @return DoctorsQueryBuilder
     */
    public function setStreet(int $street): DoctorsQueryBuilder
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @param bool $withSlots
     * @return DoctorsQueryBuilder
     */
    public function setWithSlots(bool $withSlots): DoctorsQueryBuilder
    {
        $this->withSlots = $withSlots;
        return $this;
    }

    /**
     * @param int $slotsDays
     * @return DoctorsQueryBuilder
     */
    public function setSlotsDays(int $slotsDays): DoctorsQueryBuilder
    {
        $this->slotsDays = $slotsDays;
        return $this;
    }

    /**
     * @param int $gender
     * @return DoctorsQueryBuilder
     */
    public function setGender(int $gender): DoctorsQueryBuilder
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param bool $withReviews
     * @return DoctorsQueryBuilder
     */
    public function setWithReviews(bool $withReviews): DoctorsQueryBuilder
    {
        $this->withReviews = $withReviews;
        return $this;
    }

    /**
     * @param bool $splitClinic
     * @return DoctorsQueryBuilder
     */
    public function setSplitClinic(bool $splitClinic): DoctorsQueryBuilder
    {
        $this->splitClinic = $splitClinic;
        return $this;
    }

    /**
     * @param string $illness
     * @return DoctorsQueryBuilder
     */
    public function setIllness(string $illness): DoctorsQueryBuilder
    {
        $this->illness = $illness;
        return $this;
    }
}
