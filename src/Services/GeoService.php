<?php


namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Interfaces\Services\GeoServiceInterface;

/**
 * Class GeoService
 * @package Leyhmann\DocDoc\Services
 */
class GeoService extends AbstractService implements GeoServiceInterface
{
    /**
     * Get a list of nearby areas
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function nearDistricts(int $districtID, int $limit = 50): array
    {
        return $this->getOnly("nearDistricts/id/{$districtID}/limit/{$limit}", 'DistrictList');
    }

    /**
     * Get the city by coordinates
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function detectCity(float $lat, float $lng): array
    {
        return $this->getOnly("detectCity/lat/{$lat}/lng/{$lng}", 'City');
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getCities(): array
    {
        return $this->getOnly('city', 'CityList');
    }

    /**
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getMoscowArea(): array
    {
        return $this->getOnly('area', 'AreaList');
    }

    /**
     * Get a list of districts
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getDistricts(int $cityId = null, int $areaId = null): array
    {
        return $this->getOnly('district/?' . \http_build_query([
                'city' => $cityId,
                'area' => $areaId,
            ]), 'DistrictList');
    }

    /**
     * Get a list of streets
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getStreets(int $cityID): array
    {
        return $this->getOnly("street/city/{$cityID}/", 'StreetList');
    }
}
