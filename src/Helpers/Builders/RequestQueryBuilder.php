<?php

namespace Leyhmann\DocDoc\Helpers\Builders;

use DateTime;

/**
 * Helper for create request
 *
 * Class RequestQueryBuilder
 * @package Leyhmann\DocDoc\Helpers
 */
class RequestQueryBuilder extends QueryBuilder
{
    /**
     * @var int
     */
    protected $city;

    /**
     * @var int
     */
    protected $doctor;

    /**
     * @var int
     */
    protected $clinic;

    /**
     * @var int
     */
    protected $speciality;

    /**
     * @var int
     */
    protected $diagnostics;

    /**
     * @var int
     */
    protected $service;

    /**
     * @var string("doctor" или "diagnostic")
     */
    protected $kind;

    /**
     * @var int
     */
    protected $departure;

    /**
     * @var DateTime
     */
    protected $dateAdmission;

    /**
     * @var string
     */
    protected $slotId;

    /**
     * @var array
     */
    protected $stations;

    /**
     * Required field
     *
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string("male","female")
     */
    protected $gender;

    /**
     * @var int
     */
    protected $clientAge;

    /**
     * @var DateTime
     */
    protected $clientBirthday;

    /**
     * @var string("multy", "adult", "child")
     */
    protected $age;

    /**
     * @var string
     */
    protected $comment;

    /**
     * @var int(0,1)
     */
    protected $validate;

    /**
     * @var string
     */
    protected $validateCode;

    /**
     * @var int
     */
    protected $requestId;

    /**
     * @param int $city
     * @return RequestQueryBuilder
     */
    public function setCity(int $city): RequestQueryBuilder
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param int $doctor
     * @return RequestQueryBuilder
     */
    public function setDoctor(int $doctor): RequestQueryBuilder
    {
        $this->doctor = $doctor;
        return $this;
    }

    /**
     * @param int $clinic
     * @return RequestQueryBuilder
     */
    public function setClinic(int $clinic): RequestQueryBuilder
    {
        $this->clinic = $clinic;
        return $this;
    }

    /**
     * @param int $speciality
     * @return RequestQueryBuilder
     */
    public function setSpeciality(int $speciality): RequestQueryBuilder
    {
        $this->speciality = $speciality;
        return $this;
    }

    /**
     * @param int $diagnostics
     * @return RequestQueryBuilder
     */
    public function setDiagnostics(int $diagnostics): RequestQueryBuilder
    {
        $this->diagnostics = $diagnostics;
        return $this;
    }

    /**
     * @param int $service
     * @return RequestQueryBuilder
     */
    public function setService(int $service): RequestQueryBuilder
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @param string $kind
     * @return RequestQueryBuilder
     */
    public function setKind(string $kind): RequestQueryBuilder
    {
        $this->kind = $kind;
        return $this;
    }

    /**
     * @param int $departure
     * @return RequestQueryBuilder
     */
    public function setDeparture(int $departure): RequestQueryBuilder
    {
        $this->departure = $departure;
        return $this;
    }

    /**
     * @param DateTime $dateAdmission
     * @return RequestQueryBuilder
     */
    public function setDateAdmission(DateTime $dateAdmission): RequestQueryBuilder
    {
        $this->dateAdmission = $dateAdmission;
        return $this;
    }

    /**
     * @param string $slotId
     * @return RequestQueryBuilder
     */
    public function setSlotId(string $slotId): RequestQueryBuilder
    {
        $this->slotId = $slotId;
        return $this;
    }

    /**
     * @param array $stations
     * @return RequestQueryBuilder
     */
    public function setStations(array $stations): RequestQueryBuilder
    {
        $this->stations = $stations;
        return $this;
    }

    /**
     * @param string $phone
     * @return RequestQueryBuilder
     */
    public function setPhone(string $phone): RequestQueryBuilder
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @param string $email
     * @return RequestQueryBuilder
     */
    public function setEmail(string $email): RequestQueryBuilder
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param string $name
     * @return RequestQueryBuilder
     */
    public function setName(string $name): RequestQueryBuilder
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $gender
     * @return RequestQueryBuilder
     */
    public function setGender(string $gender): RequestQueryBuilder
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @param int $clientAge
     * @return RequestQueryBuilder
     */
    public function setClientAge(int $clientAge): RequestQueryBuilder
    {
        $this->clientAge = $clientAge;
        return $this;
    }

    /**
     * @param string $comment
     * @return RequestQueryBuilder
     */
    public function setComment(string $comment): RequestQueryBuilder
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * @param int $validate
     * @return RequestQueryBuilder
     */
    public function setValidate(int $validate): RequestQueryBuilder
    {
        $this->validate = $validate;
        return $this;
    }

    /**
     * @param string $validateCode
     * @return RequestQueryBuilder
     */
    public function setValidateCode(string $validateCode): RequestQueryBuilder
    {
        $this->validateCode = $validateCode;
        return $this;
    }

    /**
     * @param int $requestId
     * @return RequestQueryBuilder
     */
    public function setRequestId(int $requestId): RequestQueryBuilder
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @param DateTime $clientBirthday
     * @return RequestQueryBuilder
     */
    public function setClientBirthday(DateTime $clientBirthday): RequestQueryBuilder
    {
        $this->clientBirthday = $clientBirthday;
        return $this;
    }

    /**
     * @param string $age
     * @return RequestQueryBuilder
     */
    public function setAge(string $age): RequestQueryBuilder
    {
        $this->age = $age;
        return $this;
    }
}
