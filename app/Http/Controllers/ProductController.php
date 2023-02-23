<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * すべての商品情報を取得してJSONレスポンスを返す
     *
     * @return ProductResource
     */
    public function getAllProducts(): ProductResource
    {
        $data = $this->productService->getAllProducts();
        return new ProductResource($data);
    }
}
