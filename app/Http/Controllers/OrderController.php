<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Enums\Stock;

class OrderController extends Controller
{
    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/api/allOrder",
     *     tags={"order"},
     *     summary="すべての注文情報を取得する",
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", description="注文ID", example=1),
     *              @OA\Property(property="order_date", type="date", description="注文日", example="2015-07-28"),
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
     * @return OrderResource
     */
    public function getAllOrders(): OrderResource
    {
        $orders = $this->service->getAllOrders();
        return new OrderResource($orders);
    }

    /**
     *  @OA\Get(
     *     path="/api/order",
     *     tags={"order"},
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
     *              @OA\Property(property="order_date", type="date", description="注文日", example="2015-07-28"),
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
     * @return OrderResource
     */
    public function getOrderById(Request $request): OrderResource
    {
        $order = $this->service->getOrderById($request->query('id'));
        return new OrderResource($order);
    }

    /**
     *  @OA\Post(
     *     path="/api/createOrder",
     *     tags={"order"},
     *     summary="注文を新規登録する",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"order_date","quantity","customer_id","product_id"},
     *                   @OA\Property(
     *                      property="order_date",
     *                      type="date",
     *                      description="注文日",
     *                      example="2023/03/07",
     *                     ),
     *                   @OA\Property(
     *                      property="quantity",
     *                      type="string",
     *                      description="注文量",
     *                      example="20",
     *                     ),
     *                   @OA\Property(
     *                      property="customer_id",
     *                      type="string",
     *                      description="顧客ID",
     *                      example="1",
     *                     ),
     *                   @OA\Property(
     *                      property="product_id",
     *                      type="string",
     *                      description="商品ID",
     *                      example="3",
     *                     ),
     *            )
     *     ),
     *     @OA\Response(
     *          response="201",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="successMessage", type="string", description="成功時のメッセージ", example="注文の新規登録に成功しました"),
     *          )
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="バリデーションエラー発生時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="validationErrorMessage", type="string", description="バリデーションエラー時のメッセージ", example="数量は必須です"),
     *          )
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="登録失敗時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="failedMessage", type="string", description="登録失敗時のメッセージ", example="注文の登録に失敗しました"),
     *          )
     *      )
     * )
     * 注文情報を新規作成して結果のJSONレスポンスを返す
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function createOrder(OrderRequest $request): JsonResponse
    {
        $order = $request->only(['order_date', 'quantity', 'product_id', 'customer_id', 'is_delivered']);
        $result = $this->service->createOrder($order);

        if (!$result) {
            return response()->json([
                        'failedMessage' => '注文の登録に失敗しました。'
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // 【TODO】複数の500レスポンスの記述がわかるまで一旦一律同じエラーを返す
        // if ($result === Stock::getvalue('STOCK_EMPTY')) {
        //     return response()->json([
        //             'stockEmptyMessage' => '選択した商品の在庫がありません'
        //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        // if ($result === Stock::getValue('STOCK_SHORTAGE)) {
        //     return response()->json([
        //         'stockShortageMessage' => '在庫が注文量より下回っています'
        //     ], Response::HTTP_INTERNAL_SERVER_ERROR);
        // }

        return response()->json([
                    'successMessage' => '注文の登録に成功しました'
                ], Response::HTTP_CREATED);
    }

    /**
     *  @OA\Post(
     *     path="/api/updateOrder",
     *     tags={"order"},
     *     summary="注文を更新する",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"id","order_date","quantity","customer_id","product_id"},
     *                   @OA\Property(
     *                      property="id",
     *                      type="string",
     *                      description="注文ID",
     *                      example="1",
     *                     ),
     *                   @OA\Property(
     *                      property="order_date",
     *                      type="date",
     *                      description="注文日",
     *                      example="2023/03/07",
     *                     ),
     *                   @OA\Property(
     *                      property="quantity",
     *                      type="string",
     *                      description="注文量",
     *                      example="20",
     *                     ),
     *                   @OA\Property(
     *                      property="customer_id",
     *                      type="string",
     *                      description="顧客ID",
     *                      example="1",
     *                     ),
     *                   @OA\Property(
     *                      property="product_id",
     *                      type="string",
     *                      description="商品ID",
     *                      example="3",
     *                     ),
     *            )
     *     ),
     *     @OA\Response(
     *          response="201",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="successMessage", type="string", description="成功時のメッセージ", example="注文の更新に成功しました"),
     *          )
     *      ),
     *     @OA\Response(
     *          response="422",
     *          description="バリデーションエラー発生時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="validationErrorMessage", type="string", description="バリデーションエラー時のメッセージ", example="数量は必須です"),
     *          )
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="登録失敗時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="failedMessage", type="string", description="登録失敗時のメッセージ", example="注文の更新に失敗しました"),
     *          )
     *      )
     * )
     * 注文情報を更新してJSONレスポンスを返す
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function updateOrder(OrderRequest $request): JsonResponse
    {
        $order = $request->only(['id', 'order_date', 'quantity', 'product_id', 'customer_id', 'is_delivered']);
        $result = $this->service->updateOrder($order);

        if (!$result) {
            return response()->json([
                        'failedMessage' => '注文の更新に失敗しました。'
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
                    'successMessage' => '注文の更新に成功しました'
                ], Response::HTTP_CREATED);
    }

    /**
     *  @OA\Post(
     *     path="/api/updateOrder",
     *     tags={"order"},
     *     summary="注文を更新する",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"id","order_date","quantity","customer_id","product_id"},
     *                   @OA\Property(
     *                      property="id",
     *                      type="string",
     *                      description="注文ID",
     *                      example="1",
     *                     )
     *            )
     *     ),
     *     @OA\Response(
     *          response="201",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="successMessage", type="string", description="成功時のメッセージ", example="注文の削除に成功しました"),
     *          )
     *      ),
     *     @OA\Response(
     *          response="500",
     *          description="登録失敗時のレスポンス",
     *          @OA\JsonContent(
     *                @OA\Property(property="failedMessage", type="string", description="失敗時のメッセージ", example="注文のに失敗しました"),
     *          )
     *      )
     * )
     * 注文情報を削除してJSONレスポンスを返す
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteOrder(Request $request): JsonResponse
    {
        $orderId = $request->only(['id']);
        $result = $this->service->deleteOrder($orderId['id']);

    if (!$result) {
            return response()->json([
                        'failedMessage' => '注文の削除に失敗しました'
                    ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
                    'successMessage' => '注文の削除に成功しました'
                ], Response::HTTP_CREATED);
    }
}
