<?php
declare(strict_types=1);

namespace App\Repository\Employee\Filter;

use Doctrine\ORM\QueryBuilder;

class FirstNameFilter implements FilterInterface
{
    /**
     * @inheritDoc
     */
    public function apply(QueryBuilder $queryBuilder, string $value): QueryBuilder
    {
        return $queryBuilder->andWhere(
            sprintf(
                '%s.firstName = :firstName',
                $queryBuilder->getRootAliases()[0]
            )
        )->setParameter(':firstName', $value);
    }
}
