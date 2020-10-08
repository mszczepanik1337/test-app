<?php
declare(strict_types=1);

namespace App\Repository\Employee\Sort\Strategy;

use App\Repository\Employee\Sort\Service\EmployeeCollectionSortService;
use App\Repository\Employee\Sort\SortInterface;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

class EmployeeCollectionSortStrategy
{
    private ContainerInterface $container;

    /**
     * EmployeeCollectionSortStrategy constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name
     * @return SortInterface
     * @throws Exception
     */
    public function createSort(string $name): SortInterface
    {
        try {
            return $this->container->get($name);
        } catch (ContainerExceptionInterface $exception) {
            throw new Exception(
                sprintf(
                    'Unable to create sort. Allowed fields: %s',
                    implode(',', EmployeeCollectionSortService::SORTABLE_FIELDS)
                ));
        }
    }
}
