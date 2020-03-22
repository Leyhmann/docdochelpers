<?php


namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\CityNumberIncorrect;
use Leyhmann\DocDoc\Exceptions\MaximumCount;
use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet;
use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Leyhmann\DocDoc\Helpers\Builders\DoctorsQueryBuilder;
use Leyhmann\DocDoc\Interfaces\Helpers\QueryBuilderInterface;
use Leyhmann\DocDoc\Interfaces\Services\DoctorsServiceInterface;
use function http_build_query;

/**
 * Class DoctorsService
 * @package Leyhmann\DocDoc\Services
 */
class DoctorsService extends AbstractService implements DoctorsServiceInterface
{

    /**
     * Get complete information about the doctor
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function find(int $id, int $city = null, bool $withSlots = null, int $slotDays = null): array
    {
        return $this->getFirst("doctor/{$id}/?" . http_build_query([
                'city' => $city,
                'withSlots' => $withSlots !== null ? (int)$withSlots : null,
                'slotDays' => $slotDays,
            ]), 'Doctor');
    }

    /**
     * Get complete information about the doctor by alias
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function findByAlias(string $alias, int $city = null): array
    {
        return $this->getFirst("doctor/by/alias/{$alias}/?" . http_build_query([
                'city' => $city,
            ]), 'Doctor');
    }

    /**
     * Get reviews about the doctor
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getReviews(int $id): array
    {
        return $this->getOnly("review/doctor/{$id}", 'ReviewList');
    }

    /**
     * Get recommendations before taking
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getGuidelines(int $sector = null, int $service = null, int $diagnostic = null): array
    {
        return $this->getOnly('guidelines/?' . http_build_query([
                'sector' => $sector,
                'service' => $service,
                'diagnostic' => $diagnostic,
            ]), 'Guidelines');
    }

    /**
     * Get list doctors
     * returns array DoctorList and Total
     *
     * @inheritDoc
     * @return array
     * @throws CityNumberIncorrect
     * @throws MaximumCount
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function all(int $cityID, int $count = 500, int $start = 0): array
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
     * Get a list of doctors by query
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws RequiredFieldIsNotSet
     * @throws Unauthorized
     */
    public function getDoctors(QueryBuilderInterface $builder): array
    {
        return $this->get("doctor/list/{$builder->getQueryString()}", 'DoctorList');
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     * @throws MaximumCount
     */
    public function getScheduleDoctor(array $doctorIds, int $days = 3): array
    {
        if (count($doctorIds) > 50) {
            throw new MaximumCount('Maximum allowed count is 50');
        }
        $doctorIdsQuery = implode(',', $doctorIds);
        return $this->get("schedule/doctor/doctorIds/{$doctorIdsQuery}/days/{$days}", 'DoctorId');
    }
}
