<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductRequest as Request;

use function PHPUnit\Framework\returnSelf;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Swagger_Laravel",
 *     description="Laravelで作成したAPIをSwaggerを使ってドキュメントを作成するプログラム",
 * )
 */
class ProductController extends Controller
{
    private const FAILED = 0;

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

    /**
     *  @OA\Post(
     *     path="/api/createProduct",
     *     tags={"product"},
     *     summary="商品情報を新規登録する",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"product_name","product_origin","description","category_id","price"},
     *                   @OA\Propery(
     *                      property="product_name",
     *                      type="string",
     *                      description="商品名",
     *                      example="牡蠣"
     *                     ),
     *                   @OA\Propery(
     *                      property="product_origin",
     *                      type="string",
     *                      description="生産地",
     *                      example="広島県"
     *                     ),
     *                   @OA\Propery(
     *                      property="description",
     *                      type="string",
     *                      description="商品の説明",
     *                      example="江田島産牡蠣"
     *                     ),
     *                   @OA\Propery(
     *                      property="category_id",
     *                      type="string",
     *                      description="商品カテゴリー",
     *                      example="牡蠣"
     *                     ),
     *                   @OA\Propery(
     *                      property="price",
     *                      type="string",
     *                      description="価格",
     *                      example=""
     *                     ),
     *            )
     *     )
     *     @OA\Parameter(
     *         description="商品名",
     *         name="product_name",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="牡蠣"),
     *      ),
     *     @OA\Parameter(
     *         description="生産地",
     *         name="product_origin",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="広島県"),
     *      ),
     *     @OA\Parameter(
     *         description="商品の説明",
     *         name="description",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="江田島産の牡蠣です"),
     *      ),
     *     @OA\Parameter(
     *         description="カテゴリーID",
     *         name="category_id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="3"),
     *      ),
     *     @OA\Parameter(
     *         description="商品価格",
     *         name="price",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="string", value="300"),
     *      ),
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="successMessage", type="string", description="成功時のメッセージ", example="商品情報の新規登録に成功しました"),
     *          )
     *      )
     * )
     * 商品情報を新規登録する
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function createProduct(Request $request): JsonResponse
    {
        $data = $request->only(['product_name', 'product_origin', 'description', 'category_id', 'price']);

        $result = $this->productService->createProduct($data);

        if ($result === self::FAILED) {
            return response()->json('商品情報の登録に失敗しました', 500);
        }

        return response()->json('商品情報の新規登録に成功しました', 201);
    }
}
