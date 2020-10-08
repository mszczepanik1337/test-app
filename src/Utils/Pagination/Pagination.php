<?php

namespace App\Utils\Pagination;

class Pagination implements PaginationInterface
{
    private int $limit;
    private int $offset;

    /**
     * Pagination constructor.
     * @param int $offset
     * @param int $limit
     */
    public function __construct(?int $offset, ?int $limit)
    {
        $this->offset = $offset ?? 0;
        $this->limit = $limit ?? 30;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}
