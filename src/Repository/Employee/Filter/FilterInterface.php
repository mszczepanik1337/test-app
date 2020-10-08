<?php
declare(strict_types=1);

namespace App\Repository\Employee\Filter;

use Doctrine\ORM\QueryBuilder;

interface FilterInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param string $value
     * @return QueryBuilder
     */
    public function apply(QueryBuilder $queryBuilder, string $value): QueryBuilder;
}
