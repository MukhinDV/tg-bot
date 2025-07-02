<?php

declare(strict_types=1);

namespace App\src\Response;

use OpenApi\Annotations as OA;

final class PaginatedResponse
{
    /**
     * @OA\Property(type="array")
     *
     * @var int
     */
    private $data;

    /**
     * @OA\Property(example=1, type="integer")
     *
     * @var int
     */
    private $page;

    /**
     * @OA\Property(example=10, type="integer")
     *
     * @var int
     */
    private $pageSize;

    /**
     * @OA\Property(example=25, type="integer")
     *
     * @var int
     */
    private $total;

    public function __construct($data, int $page, int $pageSize, int $total)
    {
        $this->data = $data;
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->total = $total;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function getTotal(): int
    {
        return $this->total;
    }
}
