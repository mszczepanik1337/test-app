<?php
declare(strict_types=1);

namespace App\Repository\Employee\Filter\Strategy;

use App\Repository\Employee\Filter\FilterInterface;
use App\Repository\Employee\Filter\Service\EmployeeCollectionFilterService;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;

class EmployeeCollectionFilterStrategy
{
    private ContainerInterface $container;

    /**
     * EmployeeCollectionFilterStrategy constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $name
     * @return FilterInterface
     * @throws Exception
     */
    public function createFilter(string $name): FilterInterface
    {
        try {
            return $this->container->get($name);
        } catch (ContainerExceptionInterface $exception) {
            throw new Exception(
                sprintf(
                    'Unable to create filter. Allowed filters: %s',
                    implode(',', EmployeeCollectionFilterService::FILTERABLE_FIELDS)
            ));
        }
    }
}
