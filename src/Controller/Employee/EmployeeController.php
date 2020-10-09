<?php
declare(strict_types=1);

namespace App\Controller\Employee;

use App\Controller\AbstractController;
use App\Entity\Employee\Employee;
use App\Mapper\Employee\EmployeeToArrayMapper;
use App\Repository\Department\DepartmentRepository;
use App\Repository\Employee\EmployeeRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations;

class EmployeeController extends AbstractController
{
    /**
     * @Rest\Get("/employees")
     * @param EmployeeRepositoryInterface $employeeRepository
     * @return Response
     * @throws Exception
     * @Annotations\QueryParam(name="offset", requirements="\d+", default=0, strict=true)
     * @Annotations\QueryParam(name="limit", requirements="\d+", default=30, strict=true)
     * @Annotations\QueryParam(name="sortBy", requirements="[a-zA-Z]+", nullable=true, strict=true)
     * @Annotations\QueryParam(name="order", requirements="(asc|desc)", nullable=true, strict=true)
     * @Annotations\QueryParam(map=true, name="filters", nullable=true)
     */
    public function getEmployeesCollection(EmployeeRepositoryInterface $employeeRepository): Response
    {
        try {
            $employees = $employeeRepository->getEmployeesCollection(
                $this->getPagination(),
                $this->getSort(),
                $this->getFilters()
            );

            return $this->json(
                EmployeeToArrayMapper::mapCollection($employees)
            );
        } catch (Exception $exception) {
            return $this->json($exception->getMessage());
        }

    }

    /**
     * @Rest\Post("/employees")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param DepartmentRepository $repository
     * @return Response
     * @throws Exception
     */
    public function createEmployee(
        Request $request,
        EntityManagerInterface $entityManager,
        DepartmentRepository $repository
    ): Response
    {
        // Założenie "Można dodawać nowych pracowników (może być poprzez ręcznie robiony INSERT do tabeli)" rozumiem tak,
        // że jest potrzeba dodania pracownika na szybko, dlatego zakładam 'happy path', brak walidacji i ujemne punkty stylu
        $data = json_decode($request->getContent(), true);

        $employee = new Employee();
        $employee->setFirstName($data['firstName']);
        $employee->setLastName($data['lastName']);
        $employee->setDepartment($repository->findOneByName($data['department']));
        $employee->setBaseSalary($data['baseSalary']);
        $employee->setSupplementType($data['supplementType']);

        $entityManager->persist($employee);
        $entityManager->flush($employee);


        return $this->json([]);
    }


}
