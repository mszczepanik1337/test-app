<?php
declare(strict_types=1);

namespace App\Mapper\Department;

use App\Entity\Department\Department;

class DepartmentToArrayMapper
{
    /**
     * @param Department $department
     * @return array
     */
    public static function map(Department $department)
    {
        return [
            'name' => $department->getName(),
            'salaryPercentageSupplement' => $department->getSalaryPercentageSupplement()
        ];
    }
}
