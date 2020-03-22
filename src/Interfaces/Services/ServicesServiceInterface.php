<?php


namespace Leyhmann\DocDoc\Interfaces\Services;

use Leyhmann\DocDoc\Interfaces\Helpers\QueryBuilderInterface;

/**
 * Interface ServicesServiceInterface
 * @package Leyhmann\DocDoc\Interfaces\Services
 */
interface ServicesServiceInterface
{
    /**
     * Getting a list of services
     *
     * @return array
     */
    public function getServices(): array;

    /**
     * Getting a list of items to search for auto-completion
     *
     * @param int $cityId City ID. Example 1
     * @param string $search Search text. Example "ak"
     * @param bool|null $withoutClinics 0 - search for all entities 1 - do not include in the clinic search result. Example 0
     * @param int|null $count the number of output values of each type. The maximum value is 15. Example 3. Default 5.
     * @param string[]|null $types The types that need to be returned are separated by a comma. Possible values:  speciality, doctor, service, clinic, illness.
     * @return array
     */
    public function autocomplete(int $cityId, string $search, bool $withoutClinics = null, $count = null, $types = null): array;

    /**
     * Getting a list of clinics
     *
     * @param string $search Text search. Example "ak"
     * @param int $cityId City ID. Example 1
     * @param int $speciality Speciality ID. Example 90
     * @param bool|null $kids Consider taking children. Example 1
     * @param bool|null $adults Consider taking adults
     * @param int|null $count Count results. Example 1
     * @param int|null $from From which output element to start the search. Example: 1
     * @return array
     */
    public function autocompleteClinics(string $search, int $cityId, int $speciality, bool $kids = null, bool $adults = null, int $count = null, int $from = null): array;

    /**
     * Getting statistics
     *
     * @param int|null $cityID Statistics for the city. If absent - for all cities. Example: 1
     * @param int|null $byPartner Statistics for the partner. If absent - for the entire dock. Number (0|1). Example: 0.
     * @return array
     */
    public function getStatistics(int $cityID = null, int $byPartner = null): array;

    /**
     * Getting a static page
     *
     * @param string $alias Page name
     * @return string
     */
    public function getPage(string $alias): string;

    /**
     * Send request
     *
     * @param QueryBuilderInterface $queryBuilder
     * @return array
     */
    public function request(QueryBuilderInterface $queryBuilder): array;

    /**
     * Get the cost and status of affiliate reward by application number
     *
     * @param int $requestId Request ID. Example 12345
     * @return array
     */
    public function getRequestCost(int $requestId): array;

    /**
     * Get speciality list
     *
     * @param int $cityID City ID. Example 1
     * @param bool|null Unique specialization. false - do not pay attention to the uniqueness of the specialty, choose with double true - receive only unique specialties (default). Example: 1
     * @return array
     */
    public function getSpecialities(int $cityID, bool $onlySimple = null): array;

    /**
     * List of Popular Specializations
     *
     * @param bool|null $children Use in a selection of pediatric doctors. false - do not use true - use if nothing is passed, the parameter will not be taken into account Example: false.
     * @param int|null $count Number of displayed specializations (<= 10)
     * @param int|null $cityID City ID. Example 1
     * @return array
     */
    public function getTopSpecialities(bool $children = null, int $count = null, int $cityID = null): array;

    /**
     * Getting a list of diagnostic services and sub-services
     *
     * @return array
     */
    public function getDiagnostics(): array;
}
