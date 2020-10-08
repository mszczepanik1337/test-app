<?php
declare(strict_types=1);

namespace App\Repository\Employee\Sort;

use Doctrine\ORM\QueryBuilder;

class FirstNameSort implements SortInterface
{
    /**
     * @inheritDoc
     */
    public function apply(QueryBuilder $queryBuilder, string $value, string $order): QueryBuilder
    {
        return $queryBuilder->orderBy(
            sprintf(
                '%s.firstName',
                $queryBuilder->getRootAliases()[0]
            ),
            $order
        );
    }
}
