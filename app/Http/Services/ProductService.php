<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * すべての商品情報を取得する
     *
     * @return Collection
     */
    public function getAllProducts(): Collection
    {
        return $this->product->getAll();
    }

    /**
     * 商品IDから商品情報を取得する
     *
     * @param string $id 商品ID
     * @return Collection
     */
    public function getProductById($id): Collection
    {
        return $this->product->getProductById($id);
    }

    public function createProduct(array $data)
    {
        return $this->product->createProduct($data);
    }

    /**
     * 商品情報を更新する
     *
     * @param $data
     * @return boolean
     */
    public function updateProduct(array $data): bool
    {
        return $this->product->updateProduct($data);
    }

    /**
     * 商品情報を削除する
     *
     * @param string $id
     * @return boolean
     */
    public function deleteProduct(string $id): bool
    {
        return $this->product->deleteProduct($id);
    }
}
