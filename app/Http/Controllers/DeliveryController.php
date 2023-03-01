<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeliveryResource;
use Illuminate\Http\Request;
use App\Http\Services\DeliveryService;

class DeliveryController extends Controller
{
    public function __construct(DeliveryService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/allDelivery",
     *     tags={"delivery"},
     *     summary="すべての注文情報を取得する",
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", description="注文ID", example=1),
     *              @OA\Property(property="delivery_date", type="date", description="注文日", example="2015-07-28"),
     *              @OA\Property(property="quantity", type="string", description="注文量", example="20"),
     *              @OA\Property(property="product_id", type="string", description="商品ID", example="1"),
     *              @OA\Property(property="customer_id", type="string", description="顧客ID", example="1"),
     *              @OA\Property(property="is_delivered", type="boolean", description="出荷フラグ", example="true"),
     *              @OA\Property(property="created_at", type="string", description="作成日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="updated_at", type="string", description="更新日時", example="2023-02-23T10:33:28.000000Z"),
     *          )
     *      )
     * )
     * すべての注文情報を取得してJSONレスポンスを返す
     *
     * @return DeliveryResource
     */
    public function getAllDeliveries(): DeliveryResource
    {
        $deliveries = $this->service->getAllDeliveries();
        return new DeliveryResource($deliveries);
    }

    /**
     *  @OA\Get(
     *     path="/api/delivery",
     *     tags={"delivery"},
     *     summary="注文IDから注文情報を取得する",
     *     @OA\Parameter(
     *         description="注文ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="サンプルID"),
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", description="注文ID", example=1),
     *              @OA\Property(property="delivery_date", type="date", description="注文日", example="2015-07-28"),
     *              @OA\Property(property="quantity", type="string", description="注文量", example="20"),
     *              @OA\Property(property="product_name", type="string", description="商品名", example="ブロッコリー"),
     *              @OA\Property(property="prefecture", type="string", description="都道府県", example="愛知県"),
     *              @OA\Property(property="city", type="string", description="市町村", example="名古屋市"),
     *              @OA\Property(property="address", type="string", description="住所", example="千種区光ケ丘"),
     *              @OA\Property(property="customer_name", type="string", description="顧客名", example="山田太郎"),
     *              @OA\Property(property="is_delivered", type="boolean", description="出荷フラグ", example="true"),
     *              @OA\Property(property="created_at", type="string", description="作成日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="updated_at", type="string", description="更新日時", example="2023-02-23T10:33:28.000000Z"),
     *          )
     *      )
     * )
     * 注文IDから注文情報を取得する
     *
     * @param Request $request
     * @return DeliveryResource
     */
    public function getDeliveryById(Request $request): DeliveryResource
    {
        $delivery = $this->service->getDeliveryById($request->query('id'));
        return new DeliveryResource($delivery);
    }
}
