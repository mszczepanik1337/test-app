<?php
declare(strict_types=1);

namespace App\Repository\Employee\Sort;

use Doctrine\ORM\QueryBuilder;

interface SortInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param string $field
     * @param string $order
     * @return QueryBuilder
     */
    public function apply(QueryBuilder $queryBuilder, string $field, string $order): QueryBuilder;
}
