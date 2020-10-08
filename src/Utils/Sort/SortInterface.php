<?php
declare(strict_types=1);

namespace App\Utils\Sort;

interface SortInterface
{
    /**
     * @return string
     */
    public function getField(): ?string;

    /**
     * @return string
     */
    public function getOrder(): string;
}
