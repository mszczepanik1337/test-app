<?php
declare(strict_types=1);

namespace App\Mapper\Employee;

use App\Entity\Employee\Employee;
use App\Mapper\Department\DepartmentToArrayMapper;
use App\Utils\Date\DateHelper;

class EmployeeToArrayMapper
{
    /**
     * @param Employee $employee
     * @return array
     * @throws \Exception
     */
    public static function map(Employee $employee)
    {
        return [
            'firstName' => $employee->getFirstName(),
            'lastName' => $employee->getLastName(),
            'baseSalary' => $employee->getBaseSalary(),
            'department' => DepartmentToArrayMapper::map($employee->getDepartment()),
            'supplementAmount' => $employee->getSupplementAmount(),
            'supplementType' => $employee->getSupplementType(),
            'totalSalary' => $employee->getTotalSalary()
        ];
    }

    /**
     * @param array $employees
     * @return array
     */
    public static function mapCollection(array $employees): array
    {
        return array_map(static function (Employee $employee) {
            return EmployeeToArrayMapper::map($employee);
        }, $employees);
    }
}
