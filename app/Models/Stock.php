<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Stock extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * 商品IDから在庫を取得する
     *
     * @param string $id
     * @return Collection
     */
    public function getStockByProductId(string $id): Collection
    {
        return Stock::where('product_id', $id)->get();
    }
}
