<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Swagger_Laravel",
 *     description="Laravelで作成したAPIをSwaggerを使ってドキュメントを作成するプログラム",
 * )
 */
class ProductController extends Controller
{
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @OA\Get(
     *     path="/api/allProduct",
     *     tags={"product"},
     *     summary="すべての商品情報と在庫情報を取得する",
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", description="商品情報ID", example=1),
     *              @OA\Property(property="product_name", type="string", description="製品名", example="ブロッコリー"),
     *              @OA\Property(property="product_origin", type="string", description="生産地", example="北海道"),
     *              @OA\Property(property="category_id", type="string", description="カテゴリーID", example="1"),
     *              @OA\Property(property="price", type="string", description="価格", example="100"),
     *              @OA\Property(property="created_at", type="string", description="作成日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="updated_at", type="string", description="更新日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="quantity", type="string", description="在庫量", example="20"),
     *          )
     *      )
     * )
     * すべての商品情報を取得してJSONレスポンスを返す
     *
     * @return ProductResource
     */
    public function getAllProducts(): ProductResource
    {
        $data = $this->productService->getAllProducts();
        return new ProductResource($data);
    }

    /**
     * @OA\Get(
     *     path="/api/product?id=1",
     *     tags={"product"},
     *     summary="商品IDから商品情報と在庫情報を取得する",
     *     @OA\Parameter(
     *         description="商品ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="サンプルID"),
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", description="商品情報ID", example=1),
     *              @OA\Property(property="product_name", type="string", description="製品名", example="ブロッコリー"),
     *              @OA\Property(property="product_origin", type="string", description="生産地", example="北海道"),
     *              @OA\Property(property="category_id", type="string", description="カテゴリーID", example="1"),
     *              @OA\Property(property="price", type="string", description="価格", example="100"),
     *              @OA\Property(property="created_at", type="string", description="作成日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="updated_at", type="string", description="更新日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="quantity", type="string", description="在庫量", example="20"),
     *          )
     *      )
     * )
     *商品のIDから商品の情報を取得する
     *
     * @param Request $request
     * @return ProductResource
     */
    public function getProductById(Request $request): ProductResource
    {
        $id = $request->query('id');
        $data = $this->productService->getProductById($id);
        return new ProductResource($data);
    }
}
