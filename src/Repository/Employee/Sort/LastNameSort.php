<?php
declare(strict_types=1);

namespace App\Repository\Employee\Sort;

use Doctrine\ORM\QueryBuilder;

class LastNameSort implements SortInterface
{
    /**
     * @inheritDoc
     */
    public function apply(QueryBuilder $queryBuilder, string $value, string $order): QueryBuilder
    {
        return $queryBuilder->orderBy(
            sprintf(
                '%s.lastName',
                $queryBuilder->getRootAliases()[0]
            ),
            $order
        );
    }
}
