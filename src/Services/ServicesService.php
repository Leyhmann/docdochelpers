<?php


namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\InvalidArgument;
use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Leyhmann\DocDoc\Helpers\Headers;
use Leyhmann\DocDoc\Interfaces\Helpers\QueryBuilderInterface;
use Leyhmann\DocDoc\Interfaces\Services\ServicesServiceInterface;
use function json_decode;
use function json_encode;

/**
 * Class ServicesService
 * @package Leyhmann\DocDoc\Services
 */
class ServicesService extends AbstractService implements ServicesServiceInterface
{
    /**
     * Get a list of services
     *
     * @return array
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getServices(): array
    {
        return $this->getOnly('service/list', 'ServiceList');
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function autocomplete(int $cityId, string $search, bool $withoutClinics = null, $count = null, $types = null): array
    {
        if ($withoutClinics !== null) {
            $withoutClinics = $this->boolToInt($withoutClinics);
        }
        if ($types !== null) {
            array_walk($types, function (string $type) {
                if (!in_array($type, ['speciality', 'doctor', 'service', 'clinic', 'illness'])) {
                    throw new InvalidArgument("Type is invalid. Possible values: speciality, doctor, service, clinic, illness.");
                }
            });
        }
        return $this->getOnly(
            "autocomplete/city/{$cityId}?" . http_build_query([
                'search' => $search,
                'withoutClinics' => $withoutClinics,
                'count' => $count,
                'types' => $types,
            ]),
            'Suggestions'
        );
    }

    /**
     * @inheritDoc
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function autocompleteClinics(string $search, int $cityId, int $speciality, bool $kids = null, bool $adults = null, int $count = null, int $from = null): array
    {
        return $this->getOnly(
            "autocomplete/city/{$cityId}?" . http_build_query([
                'search' => $search,
                'speciality' => $speciality,
                'kids' => $kids === null ? $this->boolToInt($kids) : $kids,
                'adults' => $adults === null ? $this->boolToInt($adults) : $adults,
                'count' => $count,
                'from' => $from,
            ]),
            'Suggestions'
        );
    }

    /**
     * @inheritDoc
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function getStatistics(int $cityID = null, int $byPartner = null): array
    {
        return $this->get('stat/city' .
        $cityID ? "/city/{$cityID}" : '' .
        $byPartner !== null ? "/byPartner/{$byPartner}" : '',
            'Requests');
    }

    /**
     * @inheritDoc
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function getPage(string $alias): string
    {
        $result = $this->getOnly("page/{$alias}", 'Page');
        if (isset($result['Text'])) {
            return $result['Text'];
        }
        throw new ResponseError("Response doesn't has Text key");
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function request(QueryBuilderInterface $queryBuilder): array
    {
        $this->client->setMethod('request');
        $response = json_decode($this->client->post(
            new Headers(['Content-Type' => 'application/json']),
            json_encode($queryBuilder->getQuery())
        )->getBody()->getContents(), true);
        if (isset($response['Response'])) {
            return $response['Response'];
        }
        throw new ResponseError($response['message'] ?? 'Response is error');
    }

    /**
     * @inheritDoc
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function getRequestCost(int $requestId): array
    {
        return $this->get("request/cost/requestId/{$requestId}", 'cost');
    }

    /**
     * Get a list of special values
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getSpecialities(int $cityID, bool $onlySimple = null): array
    {
        return $this->getOnly("speciality/city/{$cityID}" .
            ($onlySimple !== null ? '/onlySimple/' . $this->boolToInt($onlySimple) : ''), 'SpecList');
    }

    /**
     * @inheritDoc
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function getTopSpecialities(bool $children = null, int $count = null, int $cityID = null): array
    {
        return $this->get("speciality/top?" . http_build_query([
                'deti' => $children !== null ? $this->boolToInt($children) : null,
                'count' => $count,
                'cityId' => $cityID,
            ]), 'SpecList');
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws MethodIsNotSet
     * @throws Unauthorized
     */
    public function getDiagnostics(): array
    {
        return $this->getOnly('diagnostic', 'DiagnosticList');
    }
}
