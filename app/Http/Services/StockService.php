<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Stock;

class StockService
{
    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * すべての在庫情報を取得する
     *
     * @return void
     */
    public function getAllStocks()
    {
        return $this->stock->getAllStocks();
    }
}
