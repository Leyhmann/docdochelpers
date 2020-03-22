<?php


namespace Leyhmann\DocDoc\Services;

use DateTime;
use Leyhmann\DocDoc\Exceptions\InvalidArgument;
use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet;
use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Leyhmann\DocDoc\Interfaces\Helpers\QueryBuilderInterface;
use Leyhmann\DocDoc\Interfaces\Services\ClinicsServiceInterface;
use function http_build_query;
use function implode;

/**
 * Class ClinicsService
 * @package Leyhmann\DocDoc\Services
 */
class ClinicsService extends AbstractService implements ClinicsServiceInterface
{
    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws RequiredFieldIsNotSet
     * @throws Unauthorized
     */
    public function getClinics(QueryBuilderInterface $builder): array
    {
        return $this->get("clinic/list{$builder->getQueryString()}", 'ClinicList');
    }

    /**
     * Get full information about the clinic
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function find(int $id): array
    {
        return $this->getFirst("clinic/{$id}", 'Clinic');
    }

    /**
     * Get complete information about the clinic by alias
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function findByAlias(string $alias, int $city = null): array
    {
        return $this->getFirst(
            "clinic/by/alias/{$alias}/?" . http_build_query([
                'city' => $city,
            ]),
            'Center'
        );
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
        return $this->getOnly("review/clinic/{$id}", 'ReviewList');
    }

    /**
     * Getting the count of clinics
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     * @throws InvalidArgument
     *
     */
    public function count(int $cityID = null, int $clinicType = null, array $stations = [], int $speciality = null): array
    {
        $query = [];
        $url = 'clinic/count';
        if ($cityID !== null) {
            $url .= "/city/{$cityID}";
        }
        if ($clinicType !== null) {
            if (!in_array($clinicType, [1, 2, 3])) {
                throw new InvalidArgument('Clinic type is invalid. Possible values:  1, 2,3.');
            }
            $query['clinicType'] = $clinicType;
        }
        if (!empty($stations)) {
            $query['stations'] = implode(',', $stations);
        }
        if ($speciality !== null) {
            $query['speciality'] = $speciality;
        }
        $this->client->setMethod("{$url}?" . http_build_query($query));
        $response = $this->client->getJson();
        if (isset($response['Total'])) {
            return $response;
        }
        throw new ResponseError($response['message'] ?? 'Response is error');
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getSlotsDoctor(int $doctorId, int $clinicId, DateTime $startDate, DateTime $finishDate): array
    {
        return $this->getOnly("slot/list/doctor/{$doctorId}/clinic/{$clinicId}/from/{$startDate->format('Y-m-d H:i:s')}/to/{$startDate->format('Y-m-d H:i:s')}", 'SlotList');
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getSlotsDoctorDiagnostic(int $clinicId, int $diagnosticId, DateTime $startDate, DateTime $finishDate): array
    {
        return $this->getOnly("slot/list/diagnostic/{$diagnosticId}/clinic/{$clinicId}}/from/{$startDate->format('Y-m-d H:i:s')}/to/{$startDate->format('Y-m-d H:i:s')}", 'SlotList');
    }

    /**
     * Get a list of images of the clinic
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getClinicImages(int $clinicID): array
    {
        return $this->getOnly("clinic/gallery/{$clinicID}/", 'ImageList');
    }
}
