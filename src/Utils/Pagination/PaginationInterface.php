<?php
declare(strict_types=1);

namespace App\Utils\Pagination;


interface PaginationInterface
{
    /**
     * @return int
     */
    public function getOffset(): int;

    /**
     * @return int
     */
    public function getLimit(): int;
}
