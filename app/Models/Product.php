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

    protected $fillable = [
        'product_name',
        'product_origin',
        'description',
        'category_id',
        'price'
    ];

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
        return Product::join('inventories', 'products.id', '=', 'inventories.product_id')->get();
    }

    /**
     * 商品IDから商品情報を取得する
     *
     * @param string $id 商品ID
     * @return Collection
     */
    public function getProductById($id): Collection
    {
        return Product::join('inventories', 'products.id', '=', 'inventories.product_id')
                ->where('products.id', $id)
                ->get();
    }

    /**
     * 商品情報を新規作成する
     *
     * @param array $data
     * @return boolean
     */
    public function createProduct(array $data): bool
    {
        return Product::fill($data)->save();
    }

    /**
     * 商品情報を更新する
     *
     * @param array $data
     * @return boolean
     */
    public function updateProduct(array $data): bool
    {
        $product = Product::find($data['id']);

        $product->fill($data);
        return $product->save();
    }

    /**
     * 商品情報を削除する
     *
     * @param string $id
     * @return boolean
     */
    public function deleteProduct(string $id): bool
    {
        return Product::find($id)->delete();
    }
}
