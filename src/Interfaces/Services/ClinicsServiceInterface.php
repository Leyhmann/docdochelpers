<?php


namespace Leyhmann\DocDoc\Interfaces\Services;

use DateTime;
use Leyhmann\DocDoc\Interfaces\Helpers\QueryBuilderInterface;

/**
 * Interface ClinicsServiceInterface
 * @package Leyhmann\DocDoc\Interfaces\Services
 */
interface ClinicsServiceInterface
{
    /**
     * Get clinics list
     *
     * @param QueryBuilderInterface $builder
     * @return array
     */
    public function getClinics(QueryBuilderInterface $builder): array;

    /**
     * Get full information about the clinic
     *
     * @param int $id Clinic ID. Example 5343
     * @return array
     */
    public function find(int $id): array;

    /**
     * Get complete information about the clinic by alias
     *
     * @param string $alias Clinic Alias. Example "evraziya"
     * @param int|null $city City ID. Example 1
     * @return array
     */
    public function findByAlias(string $alias, int $city = null): array;

    /**
     * Get clinic reviews
     *
     * @param int $id Clinic ID. Example 5343
     * @return array
     */
    public function getReviews(int $id): array;

    /**
     * Get count clinics
     *
     * @param int|null $cityID City ID. Example 1
     * @param int|null $clinicType Type of clinic. 1 - Clinic 2 - Diag. center 3 - Private physician Example: 1. Possible values:  1, 2, 3.
     * @param int[] $stations Array metro ID
     * @param int|null $speciality Speciality ID
     * @return array
     */
    public function count(int $cityID = null, int $clinicType = null, array $stations = [], int $speciality = null): array;

    /**
     * Get doctor slots
     *
     * @param int $id Doctor Id. Example 1
     * @param int $clinicId Clinic ID. Example 230
     * @param DateTime $startDate The date of the beginning. Example 2018-01-01
     * @param DateTime $finishDate The date of the end. Example 2018-01-05
     * @return array
     */
    public function getSlotsDoctor(int $id, int $clinicId, DateTime $startDate, DateTime $finishDate): array;

    /**
     * Get a list of diagnostic slots
     *
     * @param int $clinicId Clinic ID. Example 52
     * @param int $diagnosticId Diagnostic Id. Example 105
     * @param DateTime $startDate DateTime $startDate The date of the beginning. Example 2018-01-01
     * @param DateTime $finishDate DateTime $finishDate The date of the end. Example 2018-01-05
     * @return array
     */
    public function getSlotsDoctorDiagnostic(int $clinicId, int $diagnosticId, DateTime $startDate, DateTime $finishDate): array;

    /**
     * Get Clinic Images
     *
     * @param int $clinicID Clinic ID. Example 105
     * @return array
     */
    public function getClinicImages(int $clinicID): array;
}
