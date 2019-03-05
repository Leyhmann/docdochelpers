<?php

namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\CityNumberIncorrect;
use Leyhmann\DocDoc\Exceptions\MaximumCount;
use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Helpers\Builders\DoctorsQueryBuilder;

/**
 * Class Doctors
 * @package Leyhmann\DocDoc\Services
 */
class Doctors extends AbstractCategory
{
    /**
     * Get all the doctors
     * returns array DoctorList and Total
     *
     * @param int $cityID
     * @param int $count
     * @param int $start
     * @return array
     * @throws CityNumberIncorrect
     * @throws MaximumCount
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function all(int $cityID, int $count = 500, int $start = 1): array
    {
        if ($count > 500) {
            throw new MaximumCount('Maximum allowed count is 500');
        }
        $this->client->setMethod("doctor/list/start/{$start}/count/{$count}/city/{$cityID}/");
        $response = $this->client->getJson();
        if ((int)$response['Total'] === 0) {
            throw new CityNumberIncorrect('Invalid city id passed');
        }
        if (isset($response['status']) && $response['status'] === 'error') {
            throw new ResponseError($response['message'] ?? 'Bad response');
        }
        return $response;
    }

    /**
     * Get a list of doctors
     *
     * @param DoctorsQueryBuilder $builder
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getDoctors(DoctorsQueryBuilder $builder): array
    {
        return $this->get("/doctor/list/{$builder->getQueryString()}", 'DoctorList');
    }

    /**
     * Get complete information about the doctor
     *
     * @param int $id
     * @param int|null $city
     * @param bool|null $withSlots
     * @param int|null $slotDays
     * @return mixed
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function find(int $id, int $city = null, bool $withSlots = null, int $slotDays = null)
    {
        return $this->getFirst("doctor/{$id}/?" . \http_build_query([
                'city' => $city,
                'withSlots' => $withSlots !== null ? (int)$withSlots : null,
                'slotDays' => $slotDays,
            ]), 'Doctor');
    }

    /**
     * Get complete information about the doctor by alias
     *
     * @param string $alias
     * @param int|null $city
     * @return mixed
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function findByAlias(string $alias, int $city = null)
    {
        return $this->getFirst("doctor/by/alias/{$alias}/?" . \http_build_query([
                'city' => $city,
            ]), 'Doctor');
    }

    /**
     * Get reviews about the doctor
     *
     * @param int $id
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getReview(int $id): array
    {
        return $this->getOnly("review/doctor/{$id}", 'ReviewList');
    }

    /**
     * Get a list of special values
     *
     * @param int $cityID
     * @return mixed
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getSpecialities(int $cityID)
    {
        return $this->getOnly("speciality/city/{$cityID}/", 'SpecList');
    }

    /**
     * Get a list of services
     *
     * @return mixed
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getServices()
    {
        return $this->getOnly('service/list', 'ServiceList');
    }
}
