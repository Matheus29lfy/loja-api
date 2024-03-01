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
        $sales =  $this->salesRepository->getAll();

        if(!$sales){
           return $sales;
         }

          return $this->sumTotalAmountSales($sales);
    }

    public function createSales($data)
    {
        return $this->salesRepository->create($data);
    }


    public function getSaleById($id)
    {
       $sale =  $this->salesRepository->getSaleById($id);

       if(!$sale){
        return $sale;
       }
        return $this->sumTotalAmount($sale);
    }

    private function sumTotalAmount($sale)
    {

        $totalAmount = 0;
        foreach ($sale->products as $product) {
            $totalAmount += (float)$product->price;
        }
        $sale->total_amount = $totalAmount;

             return  $sale;
    }

    private function sumTotalAmountSales($sales)
    {
        $result = [];

        foreach ($sales as $sale) {
            $totalAmount = 0;

            foreach ($sale->products as $product) {
                $totalAmount += (float)$product->price;
            }


            $saleArray = $sale->toArray();
            $saleArray['total_amount'] = $totalAmount;
            $saleArray['products'] = $sale->products->toArray();

            $result[] = $saleArray;
        }

        return $result;
    }


}
