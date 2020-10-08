<?php
declare(strict_types=1);

namespace App\Entity\Department;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $salaryPercentageSupplement;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private int $salaryConstSupplement;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getSalaryPercentageSupplement(): int
    {
        return $this->salaryPercentageSupplement;
    }

    /**
     * @param int $salaryPercentageSupplement
     */
    public function setSalaryPercentageSupplement(int $salaryPercentageSupplement): void
    {
        $this->salaryPercentageSupplement = $salaryPercentageSupplement;
    }

    /**
     * @return int
     */
    public function getSalaryConstSupplement(): int
    {
        return $this->salaryConstSupplement;
    }

    /**
     * @param int $salaryConstSupplement
     */
    public function setSalaryConstSupplement(int $salaryConstSupplement): void
    {
        $this->salaryConstSupplement = $salaryConstSupplement;
    }
}
