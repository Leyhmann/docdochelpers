<?php


namespace Leyhmann\DocDoc\Interfaces\Services;

use Leyhmann\DocDoc\Interfaces\Helpers\QueryBuilderInterface;

/**
 * Interface DoctorsServiceInterface
 * @package Leyhmann\DocDoc\Interfaces\Services
 */
interface DoctorsServiceInterface
{
    /**
     * Get complete information about the doctor
     *
     * @param int $id Doctor ID. Example: 5443
     * @param int|null $city City ID. Example: 1
     * @param bool|null $withSlots 1 - display temporary slots of the attending physician 0 - do not display temporary slots of the attending physician. Example: 1.
     * @param int|null $slotDays The number of days for which the doctor’s schedule should be displayed. This parameter applies only if the withSlots parameter is passed with a value of 1.. Example: 3. Default: 21.
     * @return array
     */
    public function find(int $id, int $city = null, bool $withSlots = null, int $slotDays = null): array;

    /**
     * Get complete information about the doctor by alias
     *
     * @param string $alias Doctor alias. Example: "Belozerova_Tatiana"
     * @param int|null $city City ID. Example 1
     * @return array
     */
    public function findByAlias(string $alias, int $city = null): array;

    /**
     * Get reviews about the doctor
     *
     * @param int $id Doctor Id. Example: 5443
     * @return array
     */
    public function getReviews(int $id): array;

    /**
     * Get recommendations before admission
     *
     * @param int|null $sector The identifier of the doctor’s specialization. Be sure to specify at least one parameter. Example: 115
     * @param int|null $service Service identifier. Be sure to specify at least one parameter. Example: 10
     * @param int|null $diagnostic Diagnostic identifier. Be sure to specify at least one parameter. Example: 12.
     * @return array
     */
    public function getGuidelines(int $sector = null, int $service = null, int $diagnostic = null): array;

    /**
     * Get doctors list
     *
     * @param int $cityID City Id. Example
     * @param int $count How many doctors should be on the list (no more than 500). Example: 5.
     * @param int $start Starting with what serial number to return the list of doctors. Example: 0.
     * @return array
     */
    public function all(int $cityID, int $count = 500, int $start = 0): array;

    /**
     * Get doctors list by filter
     *
     * @param QueryBuilderInterface $builder
     * @return array
     */
    public function getDoctors(QueryBuilderInterface $builder): array;

    /**
     * Get a doctor’s schedule
     *
     * @param int[] $doctorIds Doctors Id array (no more then 50). Example [234, 235]
     * @param int $days The number of days for which you need to get a schedule Example: 3. Default: 3.
     * @return array
     */
    public function getScheduleDoctor(array $doctorIds, int $days = 3): array;
}
