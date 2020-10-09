<?php
declare(strict_types=1);

namespace App\Repository\Employee;

use App\Entity\Employee\Employee;
use App\Utils\Pagination\PaginationInterface;
use App\Utils\Sort\SortInterface;
use Exception;

interface EmployeeRepositoryInterface
{
    /**
     * @param PaginationInterface $pagination
     * @param SortInterface $sort
     * @param array $filters
     * @return Employee[]
     * @throws Exception
     */
    public function getEmployeesCollection(
        PaginationInterface $pagination,
        SortInterface $sort,
        array $filters
    ): array;
}
