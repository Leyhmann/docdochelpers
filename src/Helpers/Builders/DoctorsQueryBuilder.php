<?php

namespace Leyhmann\DocDoc\Helpers\Builders;

use DateTime;

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
     * The maximum date for displaying the doctor’s schedule. This parameter applies only if the withSlots parameter is passed with a value of 1. Example: 2018-01-01.
     * @var DateTime|null
     */
    protected $slotMax;

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
     * @var int[]|null
     */
    protected $clinicId;

    /**
     * Limit for finishing doctors (default = 10), the parameter is applied only if the /near/ extra parameter is passed in the same request
     *
     * @var int
     */
    protected $extraLimit;

    /**
     * @var DateTime
     */
    protected $workingTime;

    /**
     * Deselect only adult doctors. In case if extradition is necessary to get doctors as host children and not. Example 1.
     *
     * @var bool
     */
    protected $withoutAdultsReception;

    /**
     * Adult intake filtration. 0 - do not accept adults 1 - accept adults. Example: 1.
     *
     * @var bool
     */
    protected $adults;

    /**
     * Clinic identifier, only this clinic will be displayed in the information on the clinics of the doctor. Example: 5343
     *
     * @var int
     */
    protected $singleClinicId;

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

    /**
     * @param string $near
     * @return DoctorsQueryBuilder
     */
    public function setNear(string $near): DoctorsQueryBuilder
    {
        $this->near = $near;
        return $this;
    }

    /**
     * @param DateTime|null $slotMax
     * @return DoctorsQueryBuilder
     */
    public function setSlotMax(?DateTime $slotMax): DoctorsQueryBuilder
    {
        $this->slotMax = $slotMax;
        return $this;
    }

    /**
     * @param int[]|null $clinicId
     * @return DoctorsQueryBuilder
     */
    public function setClinicId(?array $clinicId): DoctorsQueryBuilder
    {
        $this->clinicId = $clinicId;
        return $this;
    }

    /**
     * @param int $extraLimit
     * @return DoctorsQueryBuilder
     */
    public function setExtraLimit(int $extraLimit): DoctorsQueryBuilder
    {
        $this->extraLimit = $extraLimit;
        return $this;
    }

    /**
     * @param DateTime $workingTime
     * @return DoctorsQueryBuilder
     */
    public function setWorkingTime(DateTime $workingTime): DoctorsQueryBuilder
    {
        $this->workingTime = $workingTime;
        return $this;
    }

    /**
     * @return bool
     */
    public function isWithoutAdultsReception(): bool
    {
        return $this->withoutAdultsReception;
    }

    /**
     * @param bool $withoutAdultsReception
     * @return DoctorsQueryBuilder
     */
    public function setWithoutAdultsReception(bool $withoutAdultsReception): DoctorsQueryBuilder
    {
        $this->withoutAdultsReception = $withoutAdultsReception;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdults(): bool
    {
        return $this->adults;
    }

    /**
     * @param bool $adults
     * @return DoctorsQueryBuilder
     */
    public function setAdults(bool $adults): DoctorsQueryBuilder
    {
        $this->adults = $adults;
        return $this;
    }

    /**
     * @param int $singleClinicId
     * @return DoctorsQueryBuilder
     */
    public function setSingleClinicId(int $singleClinicId): DoctorsQueryBuilder
    {
        $this->singleClinicId = $singleClinicId;
        return $this;
    }
}
