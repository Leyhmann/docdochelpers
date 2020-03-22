<?php

namespace Leyhmann\DocDoc\Tests\Services;

use DateTime;
use Leyhmann\DocDoc\Exceptions\CityNumberIncorrect;
use Leyhmann\DocDoc\Exceptions\InvalidArgument;
use Leyhmann\DocDoc\Exceptions\MaximumCount;
use Leyhmann\DocDoc\Exceptions\MethodIsNotSet;
use Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet;
use Leyhmann\DocDoc\Exceptions\ResponseError;
use Leyhmann\DocDoc\Exceptions\Unauthorized;
use Leyhmann\DocDoc\Helpers\Builders\ClinicsQueryBuilder;
use Leyhmann\DocDoc\Services\ClinicsService;
use Leyhmann\DocDoc\Services\DoctorsService;
use function count;

class ClinicsServiceTest extends AbstractServiceTest
{
    protected $clinic;

    protected $doctor;

    /**
     * @throws MethodIsNotSet
     * @throws RequiredFieldIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetClinicsRequiredFields(): void
    {
        $this->expectException(RequiredFieldIsNotSet::class);
        $clinics = new ClinicsService($this->client);
        $clinics->getClinics(new ClinicsQueryBuilder());
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetClinicsRequiredFieldCityId(): void
    {
        $this->expectException(RequiredFieldIsNotSet::class);
        $clinics = new ClinicsService($this->client);
        $clinics->getClinics(
            (new ClinicsQueryBuilder())
                ->setCount(1)
                ->setStart(0)
        );
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetClinicsSimpleQuery(): void
    {
        $clinics = new ClinicsService($this->client);
        $result = $clinics->getClinics(
            (new ClinicsQueryBuilder())
                ->setStart(0)
                ->setCount(1)
                ->setCity(1)
        );
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('ClinicList', $result);
        $this->assertEquals(count($result['ClinicList']), 1);
        $this->assertArrayHasKey('Id', $result['ClinicList'][0]);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetClinicsStartFrom(): void
    {
        $clinics = new ClinicsService($this->client);
        $result = [
            $clinics->getClinics(
                (new ClinicsQueryBuilder())
                    ->setStart(0)
                    ->setCount(1)
                    ->setCity(1)
            ),
            $clinics->getClinics(
                (new ClinicsQueryBuilder())
                    ->setStart(1)
                    ->setCount(1)
                    ->setCity(1)
            ),
        ];
        $this->assertNotEquals($result[0]['ClinicList'][0]['Id'], $result[1]['ClinicList'][0]['Id']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetClinicsCityId(): void
    {
        $clinics = new ClinicsService($this->client);
        $result = [
            $clinics->getClinics(
                (new ClinicsQueryBuilder())
                    ->setStart(0)
                    ->setCount(1)
                    ->setCity(1)
            ),
            $clinics->getClinics(
                (new ClinicsQueryBuilder())
                    ->setStart(0)
                    ->setCount(1)
                    ->setCity(2)
            ),
        ];
        $this->assertNotEquals($result[0]['ClinicList'][0]['Id'], $result[1]['ClinicList'][0]['Id']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetClinicsStation(): void
    {
        $clinics = new ClinicsService($this->client);
        $result = $clinics->getClinics(
            (new ClinicsQueryBuilder())
                ->setStart(0)
                ->setCount(1)
                ->setCity(1)
                ->setStations([1, 2])
        );
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('ClinicList', $result);
        $this->assertEquals(count($result['ClinicList']), 1);
        $this->assertArrayHasKey('Id', $result['ClinicList'][0]);
        $this->assertEquals($result['ClinicList'][0]['Stations'][0]['Id'], '1');
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testFind(): void
    {
        $clinics = new ClinicsService($this->client);
        $clinic = $this->getDefaultClinic();
        $result = $clinics->find($clinic['Id']);
        $this->assertArrayHasKey('Id', $result);
        $this->assertEquals($result['Id'], $clinic['Id']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testFindByAlias(): void
    {
        $clinics = new ClinicsService($this->client);
        $clinic = $this->getDefaultClinic();
        $result = $clinics->findByAlias($clinic['RewriteName']);
        $this->assertArrayHasKey('Id', $result);
        $this->assertEquals($result['Id'], $clinic['Id']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetReviews(): void
    {
        $clinics = new ClinicsService($this->client);
        $clinic = $this->getDefaultClinic();
        $result = $clinics->getReviews($clinic['Id']);
        foreach ($result as $review) {
            $this->assertArrayHasKey('Id', $review);
            $this->assertArrayHasKey('Client', $review);
            $this->assertArrayHasKey('RatingQlf', $review);
            $this->assertArrayHasKey('RatingAtt', $review);
            $this->assertArrayHasKey('RatingRoom', $review);
            $this->assertArrayHasKey('Text', $review);
            $this->assertArrayHasKey('Date', $review);
            $this->assertArrayHasKey('DoctorId', $review);
            $this->assertArrayHasKey('ClinicId', $review);
            $this->assertArrayHasKey('Answer', $review);
            $this->assertArrayHasKey('WaitingTime', $review);
            $this->assertArrayHasKey('RatingDoctor', $review);
            $this->assertArrayHasKey('RatingClinic', $review);
            $this->assertArrayHasKey('TagClinicLocation', $review);
            $this->assertArrayHasKey('TagClinicService', $review);
            $this->assertArrayHasKey('TagClinicCost', $review);
            $this->assertArrayHasKey('TagClinicRecommend', $review);
            $this->assertArrayHasKey('TagDoctorAttention', $review);
            $this->assertArrayHasKey('TagDoctorExplain', $review);
            $this->assertArrayHasKey('TagDoctorQuality', $review);
            $this->assertArrayHasKey('TagDoctorRecommend', $review);
        }
    }

    /**
     * @throws InvalidArgument
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testCount(): void
    {
        $clinics = new ClinicsService($this->client);
        $result = $clinics->count(1);
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('ClinicSelected', $result);
        $this->assertIsNumeric($result['Total']);
        $this->assertIsNumeric($result['ClinicSelected']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetClinicImages(): void
    {
        $clinics = new ClinicsService($this->client);
        $clinic = $this->getDefaultClinic();
        $result = $clinics->getClinicImages($clinic['Id']);
        foreach ($result as $review) {
            $this->assertArrayHasKey('url', $review);
            $this->assertArrayHasKey('description', $review);
        }
    }

    /**
     * @throws MaximumCount
     * @throws CityNumberIncorrect
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    public function testGetSlots(): void
    {
        $clinics = new ClinicsService($this->client);
        $doctor = $this->getDefaultDoctor();
        $startDate = new DateTime();
        $finishDate = (new DateTime())->modify('+3 days');
        $result = $clinics->getSlotsDoctor($doctor['Id'], $doctor['Clinics'][0], $startDate, $finishDate);
        $this->assertIsArray($result);
        foreach ($result as $slot) {
            $this->assertArrayHasKey('Id', $slot);
            $this->assertArrayHasKey('StartTime', $slot);
            $this->assertArrayHasKey('FinishTime', $slot);
        }
    }

    /**
     * Get first clinic
     *
     * @return array
     * @throws RequiredFieldIsNotSet
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    protected function getDefaultClinic(): array
    {
        $clinics = new ClinicsService($this->client);
        if ($this->clinic === null) {
            $this->clinic = $clinics->getClinics(
                (new ClinicsQueryBuilder())
                    ->setStart(5)
                    ->setCount(1)
                    ->setCity(1)
            )['ClinicList'][0];
        }
        return $this->clinic;
    }

    /**
     * @return array
     * @throws MaximumCount
     * @throws CityNumberIncorrect
     * @throws MethodIsNotSet
     * @throws ResponseError
     * @throws Unauthorized
     */
    protected function getDefaultDoctor(): array
    {
        if ($this->doctor === null) {
            $doctors = new DoctorsService($this->client);
            $this->doctor = $doctors->all(1, 1)['DoctorList'][0];
        }
        return $this->doctor;
    }
}
