<?php

namespace Leyhmann\DocDoc\Tests\Services;

use Leyhmann\DocDoc\Services\Doctors;
use Leyhmann\DocDoc\Exceptions\MaximumCount;
use Leyhmann\DocDoc\Helpers\Builders\DoctorsQueryBuilder;

class DoctorsTest extends AbstractCategoryTest
{
    /**
     * @var array
     */
    protected $doctor;

    /**
     * @var array
     */
    protected $specialities;

    /**
     * @throws \Leyhmann\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Leyhmann\DocDoc\Exceptions\MaximumCount
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testAllMaxCount(): void
    {
        $this->expectException(MaximumCount::class);
        $doctors = new Doctors($this->client);
        $doctors->all(1, 501);
    }

    /**
     * @throws MaximumCount
     * @throws \Leyhmann\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testAll(): void
    {
        $doctors = new Doctors($this->client);
        $result = $doctors->all(1, 10);
        $this->assertCount(10, $result['DoctorList']);
        foreach ($result['DoctorList'] as $doctor) {
            $this->assertArrayHasKey('Id', $doctor);
        }
    }

    /**
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\RequiredFieldIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetDoctors(): void
    {
        $doctors = new Doctors($this->client);
        $result = $doctors->getDoctors(
            (new DoctorsQueryBuilder())
                ->setCity(1)
                ->setSpeciality($this->getSpecialitiesList()[0]['Id'])
                ->setStations([1, 2])
                ->setCount(10)
        );
        $this->assertArrayHasKey('Total', $result);
        $this->assertArrayHasKey('DoctorList', $result);
        foreach ($result['DoctorList'] as $doctor) {
            $this->assertArrayHasKey('Id', $doctor);
            $this->assertArrayHasKey('Name', $doctor);
            $this->assertArrayHasKey('Rating', $doctor);
            $this->assertArrayHasKey('Sex', $doctor);
            $this->assertArrayHasKey('Img', $doctor);
            $this->assertArrayHasKey('AddPhoneNumber', $doctor);
            $this->assertArrayHasKey('Category', $doctor);
            $this->assertArrayHasKey('Degree', $doctor);
            $this->assertArrayHasKey('Rank', $doctor);
            $this->assertArrayHasKey('Description', $doctor);
            $this->assertArrayHasKey('ExperienceYear', $doctor);
            $this->assertArrayHasKey('Price', $doctor);
            $this->assertArrayHasKey('SpecialPrice', $doctor);
            $this->assertArrayHasKey('Departure', $doctor);
            $this->assertArrayHasKey('Clinics', $doctor);
            $this->assertArrayHasKey('Alias', $doctor);
            $this->assertArrayHasKey('Specialities', $doctor);
            $this->assertArrayHasKey('Stations', $doctor);
            $this->assertArrayHasKey('BookingClinics', $doctor);
            $this->assertArrayHasKey('isActive', $doctor);
            $this->assertArrayHasKey('TextAbout', $doctor);
            $this->assertArrayHasKey('InternalRating', $doctor);
            $this->assertArrayHasKey('OpinionCount', $doctor);
            $this->assertArrayHasKey('Extra', $doctor);
            $this->assertArrayHasKey('KidsReception', $doctor);
            $this->assertArrayHasKey('ClinicsInfo', $doctor);
        }
    }

    /**
     * @throws MaximumCount
     * @throws \Leyhmann\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testFind(): void
    {
        $doctors = new Doctors($this->client);
        $doctor = $this->getDefaultDoctor();
        $result = $doctors->find($doctor['Id']);
        $this->assertEquals($doctor['Id'], $result['Id']);
    }

    /**
     * @throws MaximumCount
     * @throws \Leyhmann\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testFindByAlias(): void
    {
        $doctors = new Doctors($this->client);
        $doctor = $this->getDefaultDoctor();
        $result = $doctors->findByAlias($doctor['Alias']);
        $this->assertEquals($doctor['Id'], $result['Id']);
    }

    /**
     * @throws MaximumCount
     * @throws \Leyhmann\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetReview(): void
    {
        $doctors = new Doctors($this->client);
        $doctor = $this->getDefaultDoctor();
        $result = $doctors->getReview($doctor['Id']);
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
    public function testGetSpecialities(): void
    {
        $doctors = new Doctors($this->client);
        $result = $doctors->getSpecialities(1);
        $this->assertTrue(\count($result) > 0);
    }

    /**
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    public function testGetServices(): void
    {
        $doctors = new Doctors($this->client);
        $result = $doctors->getServices();
        $this->assertTrue(\count($result) > 0);
        foreach ($result as $service) {
            $this->assertArrayHasKey('Id', $service);
            $this->assertArrayHasKey('Name', $service);
            $this->assertArrayHasKey('Lft', $service);
            $this->assertArrayHasKey('Rgt', $service);
            $this->assertArrayHasKey('Depth', $service);
            $this->assertArrayHasKey('SectorId', $service);
            $this->assertArrayHasKey('DiagnosticaId', $service);
        }
    }

    /**
     * @return array
     * @throws MaximumCount
     * @throws \Leyhmann\DocDoc\Exceptions\CityNumberIncorrect
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    protected function getDefaultDoctor(): array
    {
        if ($this->doctor === null) {
            $doctors = new Doctors($this->client);
            $this->doctor = $doctors->all(1, 1)['DoctorList'][0];
        }
        return $this->doctor;
    }

    /**
     * @return array
     * @throws \Leyhmann\DocDoc\Exceptions\MethodIsNotSet
     * @throws \Leyhmann\DocDoc\Exceptions\ResponseError
     * @throws \Leyhmann\DocDoc\Exceptions\Unauthorized
     */
    protected function getSpecialitiesList(): array
    {
        if ($this->specialities === null) {
            $doctors = new Doctors($this->client);
            $this->specialities = $doctors->getSpecialities(1);
        }
        return $this->specialities;
    }
}
