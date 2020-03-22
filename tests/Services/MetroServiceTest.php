<?php

namespace Leyhmann\DocDoc\Tests\Services;

use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Leyhmann\DocDoc\Services\GeoService;
use Leyhmann\DocDoc\Services\MetroService;

class MetroServiceTest extends AbstractServiceTest
{
    /**
     * @var array
     */
    protected $cities;

    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetMetro(): void
    {
        $metroServer = new MetroService($this->client);
        $cities = $this->getCities();
        $result = $metroServer->getMetro($cities[0]['Id']);
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('Alias', $result[0]);
        $this->assertArrayHasKey('Name', $result[0]);
        $this->assertArrayHasKey('LineName', $result[0]);
        $this->assertArrayHasKey('LineColor', $result[0]);
        $this->assertArrayHasKey('CityId', $result[0]);
        $this->assertArrayHasKey('DistrictIds', $result[0]);
    }

    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testNearestStationGeo(): void
    {
        $metroServer = new MetroService($this->client);
        $cities = $this->getCities();
        $result = $metroServer->nearestStationGeo($cities[0]['Latitude'], $cities[0]['Longitude']);
        $this->assertArrayHasKey('Id', $result);
        $this->assertArrayHasKey('Name', $result);
        $this->assertArrayHasKey('LineName', $result);
        $this->assertArrayHasKey('LineColor', $result);
        $this->assertArrayHasKey('CityId', $result);
        $this->assertArrayHasKey('Alias', $result);
    }

    /**
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testNearestStation(): void
    {
        $metroServer = new MetroService($this->client);
        $cities = $this->getCities();
        $stations = $metroServer->getMetro($cities[0]['Id']);
        $result = $metroServer->nearestStation($stations[0]['Id']);
        $this->assertTrue(count($result) > 0);
        $this->assertArrayHasKey('Id', $result[0]);
        $this->assertArrayHasKey('Name', $result[0]);
        $this->assertArrayHasKey('LineName', $result[0]);
        $this->assertArrayHasKey('LineColor', $result[0]);
        $this->assertArrayHasKey('CityId', $result[0]);
        $this->assertArrayHasKey('Alias', $result[0]);
    }

    /**
     * @return array
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    protected function getCities(): array
    {
        if ($this->cities === null) {
            $locations = new GeoService($this->client);
            $this->cities = $locations->getCities();
        }
        return $this->cities;
    }
}
