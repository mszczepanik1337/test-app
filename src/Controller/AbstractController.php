<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utils\Pagination\Pagination;
use App\Utils\Pagination\PaginationInterface;
use App\Utils\Sort\Sort;
use App\Utils\Sort\SortInterface;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

class AbstractController extends SymfonyAbstractController
{
    /** @var ParamFetcherInterface */
    private $paramFetcher;

    /**
     * AbstractController constructor.
     * @param ParamFetcherInterface $paramFetcher
     */
    public function __construct(ParamFetcherInterface $paramFetcher)
    {
        $this->paramFetcher = $paramFetcher;
    }

    /**
     * @return PaginationInterface
     */
    public function getPagination(): PaginationInterface
    {
        return new Pagination(
            (int)$this->paramFetcher->get('offset'),
            (int)$this->paramFetcher->get('limit')
        );
    }

    /**
     * @return SortInterface
     */
    public function getSort(): SortInterface
    {
        return new Sort(
            $this->paramFetcher->get('sortBy'),
            $this->paramFetcher->get('order')
        );
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->paramFetcher->get('filters') ?? [];
    }
}
