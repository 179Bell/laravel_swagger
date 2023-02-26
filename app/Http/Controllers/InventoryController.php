<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryResource;
use App\Http\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(InventoryService $service)
    {
        $this->service = $service;
    }

    /**
     *  @OA\Get(
     *     path="/api/allInventory",
     *     tags={"inventory"},
     *     summary="すべての製品の在庫情を取得する",
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", description="商品情報ID", example=1),
     *              @OA\Property(property="product_name", type="string", description="製品名", example="ブロッコリー"),
     *              @OA\Property(property="product_origin", type="string", description="生産地", example="北海道"),
     *              @OA\Property(property="category_id", type="string", description="カテゴリーID", example="1"),
     *              @OA\Property(property="price", type="string", description="価格", example="100"),
     *              @OA\Property(property="category", type="string", description="カテゴリー", example="野菜類"),
     *              @OA\Property(property="quantity", type="string", description="在庫量", example="20"),
     *          )
     *      )
     * )
     * すべての製品の在庫情報を返す
     *
     * @return InventoryResource
     */
    public function getAllInventories(): InventoryResource
    {
        $inventories = $this->service->getAllProductInventories();
        return new InventoryResource($inventories);
    }
}
