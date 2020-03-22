<?php


namespace Leyhmann\DocDoc\Interfaces\Services;

/**
 * Interface GeoServiceInterface
 * @package Leyhmann\DocDoc\Interfaces\Services
 */
interface GeoServiceInterface
{
    /**
     * Get a list of nearby areas
     *
     * @param int $districtID District ID Example 63.
     * @param int $limit The maximum number of nearby areas in the sample. Example: 5.
     * @return array
     */
    public function nearDistricts(int $districtID, int $limit = 50): array;

    /**
     * Get the city by coordinates
     *
     * @param float $lat Latitude. Example: 37.6173
     * @param float $lng Longitude. Example: 55.755826
     * @return array
     */
    public function detectCity(float $lat, float $lng): array;

    /**
     * Get a list of cities
     *
     * @return array
     */
    public function getCities(): array;

    /**
     * Get a list of Moscow districts
     *
     * @return array
     */
    public function getMoscowArea(): array;

    /**
     * Get a list of districts
     *
     * @param int $cityId City ID. Example 1
     * @param int|null $areaId Area ID. Example 1
     * @return array
     */
    public function getDistricts(int $cityId, int $areaId = null): array;

    /**
     * Get a list of streets
     *
     * @param int $cityID City ID. Example 1
     * @return array
     */
    public function getStreets(int $cityID): array;
}
