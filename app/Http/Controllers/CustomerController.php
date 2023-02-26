<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Http\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(CustomerService $service)
    {
        $this->service = $service;
    }

    /**
     *  @OA\Get(
     *     path="/api/allCustomer",
     *     tags={"customer"},
     *     summary="すべての顧客情報を取得する",
     *     @OA\Response(
     *          response="200",
     *          description="成功時のレスポンス",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", description="顧客ID", example=1),
     *              @OA\Property(property="prefecture", type="string", description="都道府県", example="茨城県"),
     *              @OA\Property(property="city", type="string", description="市町村名", example="中島市"),
     *              @OA\Property(property="address", type="string", description="市町村以降の住所", example="若松町村山1-2-3"),
     *              @OA\Property(property="customer_name", type="string", description="顧客名", example="山田太郎"),
     *              @OA\Property(property="created_at", type="string", description="作成日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="updated_at", type="string", description="更新日時", example="2023-02-23T10:33:28.000000Z"),
     *          )
     *      )
     * )
     * すべての顧客情報を取得してJSONレスポンスを返す
     *
     * @return CustomerResource
     */
    public function getAllCustomers(): CustomerResource
    {
        $customers = $this->service->getAll();
        return new CustomerResource($customers);
    }

    /**
     *  @OA\Get(
     *     path="/api/customer?id=1",
     *     tags={"customer"},
     *     summary="顧客IDから顧客情報を取得する",
     *     @OA\Parameter(
     *         description="顧客ID",
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
     *              @OA\Property(property="id", type="integer", description="顧客ID", example=1),
     *              @OA\Property(property="prefecture", type="string", description="都道府県", example="茨城県"),
     *              @OA\Property(property="city", type="string", description="市町村名", example="中島市"),
     *              @OA\Property(property="address", type="string", description="市町村以降の住所", example="若松町村山1-2-3"),
     *              @OA\Property(property="customer_name", type="string", description="顧客名", example="山田太郎"),
     *              @OA\Property(property="created_at", type="string", description="作成日時", example="2023-02-23T10:33:28.000000Z"),
     *              @OA\Property(property="updated_at", type="string", description="更新日時", example="2023-02-23T10:33:28.000000Z"),
     *          )
     *      )
     * )
     * 顧客IDから顧客情報を検索して取得する
     *
     * @param Request $request
     * @return CustomerResource
     */
    public function getCustomer(Request $request): CustomerResource
    {
        $id = $request->query('id');
        $customer = $this->service->getCustomerById($id);
        return new CustomerResource($customer);
    }
}