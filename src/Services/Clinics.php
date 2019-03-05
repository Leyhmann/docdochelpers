<?php

namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Helpers\Builders\ClinicsQueryBuilder;

/**
 * Class Clinics
 * @package Leyhmann\DocDoc\Services
 */
class Clinics extends AbstractCategory
{
    /**
     * @param ClinicsQueryBuilder $builder
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getClinics(ClinicsQueryBuilder $builder): array
    {
        return $this->get("/clinic/list/{$builder->getQueryString()}", 'ClinicList');
    }

    /**
     * Get full information about the clinic
     *
     * @param int $id
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function find(int $id): array
    {
        return $this->getFirst("clinic/{$id}", 'Clinic');
    }

    /**
     * Get complete information about the clinic by alias
     *
     * @param string $alias
     * @param int|null $city
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function findByAlias(string $alias, int $city = null): array
    {
        return $this->getFirst(
            "clinic/by/alias/{$alias}/?" . \http_build_query([
                'city' => $city,
            ]),
            'Center'
        );
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
    public function getReviews(int $id): array
    {
        return $this->getOnly("review/clinic/{$id}", 'ReviewList');
    }

    /**
     * Getting the count of clinics
     *
     * @param int $cityID
     * @param array $clinicType
     * @param array $stations
     * @param int|null $speciality
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function count(int $cityID, array $clinicType = [], array $stations = [], int $speciality = null): array
    {
        $this->client->setMethod("clinic/count/city/$cityID/?" . \http_build_query([
                'clinicType' => \implode(',', $clinicType),
                'stations' => \implode(',', $stations),
                'speciality' => $speciality,
            ]));
        $response = $this->client->getJson();
        if (isset($response['Total'])) {
            return $response;
        }
        throw new ResponseError($response['message'] ?? 'Response is error');
    }


    /**
     * Get a list of images of the clinic
     *
     * @param int $clinicID
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getClinicImages(int $clinicID): array
    {
        return $this->getOnly("clinic/gallery/{$clinicID}/", 'ImageList');
    }

    /**
     * @return array
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getDiagnostics(): array
    {
        return $this->getOnly('diagnostic', 'DiagnosticList');
    }
}
