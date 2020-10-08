<?php
declare(strict_types=1);

namespace App\Repository\Employee\Sort\Service;

use App\Repository\Employee\Sort\Strategy\EmployeeCollectionSortStrategy;
use App\Utils\Sort\SortInterface;
use Doctrine\ORM\QueryBuilder;

class EmployeeCollectionSortService
{
    public const SERVICE_PREFIX = 'employee.collection.sort.';

    public const SORTABLE_FIELDS = [
        'firstName',
        'lastName',
        'baseSalary',
        'supplementAmount',
        'supplementType',
        'totalSalary',
        'department'
    ];

    private EmployeeCollectionSortStrategy $strategy;

    /**
     * EmployeeCollectionSortService constructor.
     * @param EmployeeCollectionSortStrategy $strategy
     */
    public function __construct(EmployeeCollectionSortStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param SortInterface $sort
     * @return QueryBuilder
     * @throws \Exception
     */
    public function applySort(QueryBuilder $queryBuilder, SortInterface $sort): QueryBuilder
    {
        if (!$sort->getField()) {
            return $queryBuilder;
        }

        $sortInstance = $this->strategy->createSort(self::SERVICE_PREFIX . $sort->getField());
        $sortInstance->apply(
            $queryBuilder,
            $sort->getField(),
            $sort->getOrder()
        );

        return $queryBuilder;
    }
}
