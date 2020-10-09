<?php
declare(strict_types=1);

namespace App\Repository\Employee;

use App\Entity\Employee\Employee;
use App\Repository\Employee\Filter\Service\EmployeeCollectionFilterService;
use App\Repository\Employee\Sort\Service\EmployeeCollectionSortService;
use App\Utils\Pagination\PaginationInterface;
use App\Utils\Sort\SortInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

class EmployeeRepository extends ServiceEntityRepository implements EmployeeRepositoryInterface
{
    private EmployeeCollectionFilterService $employeeRepositoryFilterService;
    private EmployeeCollectionSortService $employeeCollectionSortService;

    /**
     * EmployeeRepository constructor.
     * @param ManagerRegistry $registry
     * @param EmployeeCollectionFilterService $employeeRepositoryFilterService
     * @param EmployeeCollectionSortService $employeeCollectionSortService
     */
    public function __construct(
        ManagerRegistry $registry,
        EmployeeCollectionFilterService $employeeRepositoryFilterService,
        EmployeeCollectionSortService $employeeCollectionSortService
    )
    {
        parent::__construct($registry, Employee::class);
        $this->employeeRepositoryFilterService = $employeeRepositoryFilterService;
        $this->employeeCollectionSortService = $employeeCollectionSortService;
    }

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
        array $filters = []
    ): array
    {
        $qb = $this->createQueryBuilder('e')
            ->join('e.department', 'd')
            ->setFirstResult($pagination->getOffset())
            ->setMaxResults($pagination->getLimit());

        // NOT PROUD HOW IT LOOKS =)

        $yearsOfEmploymentExpr = '
            CASE 
                WHEN timestampdiff(YEAR, e.hiredAt, NOW()) < 11 THEN timestampdiff(YEAR, e.hiredAt, NOW())
                ELSE 10
            END';

        $supplementAmountExpr = sprintf("
            CASE
                WHEN (e.supplementType = '%s') THEN d.salaryConstSupplement * %s
                WHEN (e.supplementType = '%s') THEN d.salaryPercentageSupplement / 100 * e.baseSalary
                ELSE 0
            END",
            Employee::SUPPLEMENT_TYPE_CONST,
            $yearsOfEmploymentExpr,
            Employee::SUPPLEMENT_TYPE_PERCENTAGE
        );

        $totalSalaryExpr = sprintf('e.baseSalary + %s', $supplementAmountExpr);
        $qb->addSelect(
            sprintf(
                '%s as supplementAmount, %s as totalSalary',
                $supplementAmountExpr,
                $totalSalaryExpr)
        );

        $this->employeeRepositoryFilterService->applyFilters($qb, $filters);
        $this->employeeCollectionSortService->applySort($qb, $sort);

        return array_map(static function (array $result) {
            /** @var Employee $entity */
            $entity = $result[0];
            $entity->setTotalSalary((float)$result['totalSalary']);
            $entity->setSupplementAmount((float)$result['supplementAmount']);
            return $entity;
        }, $qb->getQuery()->getResult());
    }
}
