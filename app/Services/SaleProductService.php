<?php

namespace App\Services;

use App\Repositories\SaleProductRepository;

class SaleProductService
{
    protected $saleProductRepository;

    public function __construct(SaleProductRepository $saleProductRepository)
    {
        $this->saleProductRepository = $saleProductRepository;
    }

    public function addProduct($saleId, $productId, $quantity)
    {
        return $this->saleProductRepository->addProduct($saleId, $productId, $quantity);
    }

    public function canceledSale($saleId)
    {
        return $this->saleProductRepository->canceledSale($saleId);
    }

    public function finishSale($saleId)
    {
        return $this->saleProductRepository->finishSale($saleId);
    }
}
