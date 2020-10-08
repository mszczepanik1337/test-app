<?php
declare(strict_types=1);

namespace App\Repository\Employee\Filter\Service;

use App\Repository\Employee\Filter\Strategy\EmployeeCollectionFilterStrategy;
use Doctrine\ORM\QueryBuilder;
use Exception;

class EmployeeCollectionFilterService
{
    public const SERVICE_PREFIX = 'employee.collection.filter.';

    public const FILTERABLE_FIELDS = [
        'firstName',
        'lastName',
        'department'
    ];

    private EmployeeCollectionFilterStrategy $employeeRepositoryFilterStrategy;

    /**
     * EmployeeRepositoryFilterService constructor.
     * @param EmployeeCollectionFilterStrategy $employeeRepositoryFilterStrategy
     */
    public function __construct(EmployeeCollectionFilterStrategy $employeeRepositoryFilterStrategy)
    {
        $this->employeeRepositoryFilterStrategy = $employeeRepositoryFilterStrategy;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param array $filters
     * @throws Exception
     */
    public function applyFilters(QueryBuilder $queryBuilder, array $filters)
    {
        foreach ($filters as $filterName => $filterValue)  {
            $filter = $this->employeeRepositoryFilterStrategy->createFilter(self::SERVICE_PREFIX . $filterName);
            $filter->apply($queryBuilder, $filterValue);
        }
    }
}
