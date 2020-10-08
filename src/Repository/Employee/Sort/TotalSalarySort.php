<?php
declare(strict_types=1);

namespace App\Repository\Employee\Sort;

use Doctrine\ORM\QueryBuilder;

class TotalSalarySort implements SortInterface
{
    /**
     * @inheritDoc
     */
    public function apply(QueryBuilder $queryBuilder, string $value, string $order): QueryBuilder
    {
        return $queryBuilder->orderBy('totalSalary', $order);
    }
}
