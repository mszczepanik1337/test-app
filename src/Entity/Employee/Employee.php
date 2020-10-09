<?php
declare(strict_types=1);

namespace App\Entity\Employee;

use App\Entity\Department\Department;
use App\Utils\Date\DateHelper;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Exception;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /** @var string  */
   public const SUPPLEMENT_TYPE_CONST = 'const';

    /** @var string  */
   public const SUPPLEMENT_TYPE_PERCENTAGE = 'percentage';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    private string $supplementType;

    /**
     * @ORM\Column(type="decimal", nullable=false)
     */
    private float $baseSalary;

    /**
     * @ORM\Column(name="hired_at", type="datetime", nullable=false)
     */
    private DateTime $hiredAt;

    /**
     * @var Department
     * @ORM\ManyToOne(targetEntity="App\Entity\Department\Department")
     */
    private Department $department;

    /** @var float $totalSalary*/
    private float $totalSalary;

    /** @var float $supplementAmount*/
    private float $supplementAmount;

    /**
     * Employee constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->hiredAt = new DateTime();
        $this->supplementType = self::SUPPLEMENT_TYPE_PERCENTAGE;
        $this->totalSalary = 0;
        $this->supplementAmount = 0;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return float
     */
    public function getBaseSalary(): float
    {
        return $this->baseSalary;
    }

    /**
     * @param float $baseSalary
     */
    public function setBaseSalary(float $baseSalary): void
    {
        $this->baseSalary = $baseSalary;
    }

    /**
     * @return DateTimeInterface
     */
    public function getHiredAt(): DateTimeInterface
    {
        return $this->hiredAt;
    }

    /**
     * @param DateTimeInterface $hiredAt
     */
    public function setHiredAt(DateTimeInterface $hiredAt): void
    {
        $this->hiredAt = $hiredAt;
    }

    /**
     * @return Department
     */
    public function getDepartment(): Department
    {
        return $this->department;
    }

    /**
     * @param Department $department
     */
    public function setDepartment(Department $department): void
    {
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function getSupplementType(): string
    {
        return $this->supplementType;
    }

    /**
     * @param string $supplementType
     */
    public function setSupplementType(string $supplementType): void
    {
        $this->supplementType = $supplementType;
    }

    /**
     * @return bool
     */
    public function hasConstSalarySupplement(): bool
    {
        return $this->supplementType === self::SUPPLEMENT_TYPE_CONST;
    }

    /**
     * @return bool
     */
    public function hasPercentageSalarySupplement(): bool
    {
        return $this->supplementType === self::SUPPLEMENT_TYPE_CONST;
    }

    /**
     * @return float
     */
    public function getTotalSalary(): float
    {
        return $this->totalSalary;
    }

    /**
     * @param float $totalSalary
     */
    public function setTotalSalary(float $totalSalary): void
    {
        $this->totalSalary = $totalSalary;
    }

    /**
     * @return float
     */
    public function getSupplementAmount(): float
    {
        return $this->supplementAmount;
    }

    /**
     * @param float $supplementAmount
     */
    public function setSupplementAmount(float $supplementAmount): void
    {
        $this->supplementAmount = $supplementAmount;
    }
}
