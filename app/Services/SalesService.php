<?php

namespace App\Services;

use App\Repositories\SalesRepository;

class SalesService
{
    protected $salesRepository;

    public function __construct(SalesRepository $salesRepository)
    {
        $this->salesRepository = $salesRepository;
    }

    public function getAllSales()
    {
        return $this->salesRepository->getAll();
    }

    public function createSales($data)
    {
        return $this->salesRepository->create($data);
    }
}
