<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Database\Eloquent\Collection;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class);
    }

    /**
     * すべての商品情報を返す
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Product::all();
    }

    /**
     * 商品IDから商品情報を取得する
     *
     * @param string $id 商品ID
     * @return Collection
     */
    public function getProductById($id): Collection
    {
        return Product::where('id', $id)->get();
    }

    public function getAllProductInventory(): Collection
    {
        return Product::join('inventories', 'products.id', '=', 'inventories.product_id')->get();
    }
}
