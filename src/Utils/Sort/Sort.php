<?php
declare(strict_types=1);

namespace App\Utils\Sort;


use Doctrine\Common\Collections\Criteria;

class Sort implements SortInterface
{
    private ?string $field;
    private string $order;

    /**
     * Sort constructor.
     * @param $field
     * @param $order
     */
    public function __construct(?string $field, ?string $order)
    {
        $this->field = $field;
        $this->order = $order ?? Criteria::ASC;
    }

    /**
     * @return string
     */
    public function getField(): ?string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getOrder(): string
    {
        return $this->order;
    }
}
