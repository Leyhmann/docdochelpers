<?php

namespace Leyhmann\DocDoc\Tests\Services;

use Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet;
use Leyhmann\DocDoc\Helpers\Builders\ClinicsQueryBuilder;
use Leyhmann\DocDoc\Services\Clinics;

class ClinicsTest extends AbstractCategoryTest
{
    protected $clinic;

    /**
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetClinicsRequiredFields(): void
    {
        $this->expectException(RequiredFieldIsNotSet::class);
        $clinics = new Clinics($this->client);
        $clinics->getClinics(new ClinicsQueryBuilder());
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetClinicsRequiredFieldCityId(): void
    {
        $this->expectException(RequiredFieldIsNotSet::class);
        $clinics = new Clinics($this->client);
        $clinics->getClinics(
            (new ClinicsQueryBuilder())
                ->setCount(1)
                ->setStart(0)
        );
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetClinicsSimpleQuery(): void
    {
        $clinics = new Clinics($this->client);
        $result = $clinics->getClinics(
            (new ClinicsQueryBuilder())
                ->setStart(0)
                ->setCount(1)
                ->setCity(1)
        );
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('ClinicList', $result);
        $this->assertEquals(\count($result['ClinicList']), 1);
        $this->assertArrayHasKey('Id', $result['ClinicList'][0]);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetClinicsStartFrom(): void
    {
        $clinics = new Clinics($this->client);
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
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetClinicsCityId(): void
    {
        $clinics = new Clinics($this->client);
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
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetClinicsStation(): void
    {
        $clinics = new Clinics($this->client);
        $result = $clinics->getClinics(
            (new ClinicsQueryBuilder())
                ->setStart(0)
                ->setCount(1)
                ->setCity(1)
                ->setStations([1, 2])
        );
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('ClinicList', $result);
        $this->assertEquals(\count($result['ClinicList']), 1);
        $this->assertArrayHasKey('Id', $result['ClinicList'][0]);
        $this->assertEquals($result['ClinicList'][0]['Stations'][0]['Id'], '1');
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testFind(): void
    {
        $clinics = new Clinics($this->client);
        $clinic = $this->getDefaultClinic();
        $result = $clinics->find($clinic['Id']);
        $this->assertArrayHasKey('Id', $result);
        $this->assertEquals($result['Id'], $clinic['Id']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testFindByAlias(): void
    {
        $clinics = new Clinics($this->client);
        $clinic = $this->getDefaultClinic();
        $result = $clinics->findByAlias($clinic['RewriteName']);
        $this->assertArrayHasKey('Id', $result);
        $this->assertEquals($result['Id'], $clinic['Id']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetReviews(): void
    {
        $clinics = new Clinics($this->client);
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
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testCount(): void
    {
        $clinics = new Clinics($this->client);
        $result = $clinics->count(1);
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('ClinicSelected', $result);
        $this->assertIsNumeric($result['Total']);
        $this->assertIsNumeric($result['ClinicSelected']);
    }

    /**
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetClinicImages(): void
    {
        $clinics = new Clinics($this->client);
        $clinic = $this->getDefaultClinic();
        $result = $clinics->getClinicImages($clinic['Id']);
        foreach ($result as $review) {
            $this->assertArrayHasKey('url', $review);
            $this->assertArrayHasKey('description', $review);
        }
    }

    /**
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetDiagnostics(): void
    {
        $clinics = new Clinics($this->client);
        $diagnostics = $clinics->getDiagnostics();
        $this->assertTrue(\count($diagnostics) > 0);
        foreach ($diagnostics as $diagnostic) {
            $this->assertArrayHasKey('Name', $diagnostic);
            $this->assertArrayHasKey('Alias', $diagnostic);
            $this->assertArrayHasKey('SubDiagnosticList', $diagnostic);
        }
    }

    /**
     * Get first clinic
     *
     * @return array
     * @throws RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    protected function getDefaultClinic(): array
    {
        $clinics = new Clinics($this->client);
        if ($this->clinic === null) {
            $this->clinic = $clinics->getClinics(
                (new ClinicsQueryBuilder())
                    ->setStart(0)
                    ->setCount(1)
                    ->setCity(1)
            )['ClinicList'][0];
        }
        return $this->clinic;
    }
}
