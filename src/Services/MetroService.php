<?php


namespace Leyhmann\DocDoc\Services;

use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Interfaces\Services\MetroServiceInterface;

/**
 * Class MetroService
 * @package Leyhmann\DocDoc\Services
 */
class MetroService extends AbstractService implements MetroServiceInterface
{
    /**
     * Get the nearest metro station by coordinates
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function nearestStationGeo(float $lat, float $lng, int $city = null): array
    {
        $query = "nearestStationGeo/lat/{$lat}/lng/{$lng}/";
        if ($city !== null) {
            $query .= "city/{$city}";
        }
        return $this->getOnly($query, 'Station');
    }

    /**
     * Get a list of the nearest metro stations
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function nearestStation(int $stationID): array
    {
        return $this->getOnly("nearestStation/id/{$stationID}/", 'StationList');
    }

    /**
     * Get a list of metro stations
     *
     * @inheritDoc
     * @throws ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function getMetro(int $cityID): array
    {
        return $this->getOnly("metro/city/{$cityID}/", 'MetroList');
    }
}
