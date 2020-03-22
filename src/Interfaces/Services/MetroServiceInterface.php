<?php


namespace Leyhmann\DocDoc\Interfaces\Services;

/**
 * Interface MetroServiceInterface
 * @package Leyhmann\DocDoc\Interfaces\Services
 */
interface MetroServiceInterface
{
    /**
     * Get the nearest metro station by coordinates
     *
     * @param float $lat Latitude. Example: 55.7514305
     * @param float $lng Longitude. Example: 55.7514305
     * @param int $cityId City ID. Example: 1
     * @return array
     */
    public function nearestStationGeo(float $lat, float $lng, int $cityId = null): array;

    /**
     * Get a list of nearby metro stations
     *
     * @param int $stationID Unique numerical identifier of the station. Example: 1
     * @return array
     */
    public function nearestStation(int $stationID): array;

    /**
     * Get a list of metro stations
     *
     * @param int $cityID City ID. Example 1
     * @return array
     */
    public function getMetro(int $cityID): array;
}
