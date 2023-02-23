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
}
