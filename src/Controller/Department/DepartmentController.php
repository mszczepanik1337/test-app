<?php
declare(strict_types=1);

namespace App\Controller\Department;

use App\Controller\AbstractController;
use App\Entity\Department\Department;
use App\Mapper\Department\DepartmentToArrayMapper;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartmentController extends AbstractController
{
    /**
     * @Rest\Post("/departments")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function createDepartment(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        // Założenie "Można dodawać nowych pracowników (może być poprzez ręcznie robiony INSERT do tabeli)" rozumiem tak,
        // że jest potrzeba dodania pracownika na szybko, dlatego zakładam 'happy path', brak walidacji i ujemne punkty stylu
        $data = json_decode($request->getContent(), true);

        $department = new Department();
        $department->setName($data['name']);
        $department->setSalaryPercentageSupplement($data['salaryPercentageSupplement']);
        $department->setSalaryConstSupplement($data['salaryConstSupplement']);

        $entityManager->persist($department);
        $entityManager->flush($department);


        return $this->json(
            DepartmentToArrayMapper::map($department)
        );
    }
}
