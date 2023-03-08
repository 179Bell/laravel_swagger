<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class Inventory extends Model
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
    public function getInventoryByProductId(string $id): Collection
    {
        return Inventory::where('product_id', $id)->get();
    }
}
