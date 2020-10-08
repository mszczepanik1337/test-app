<?php
declare(strict_types=1);

namespace App\Repository\Employee\Filter;

use Doctrine\ORM\QueryBuilder;

class DepartmentFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function apply(QueryBuilder $queryBuilder, string $value): QueryBuilder
    {
        return $queryBuilder
            ->andWhere('d.name = :name')
            ->setParameter(':name', $value);
    }
}
