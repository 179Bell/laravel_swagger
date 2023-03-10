<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Delivery;
use App\Models\Stock;
use Illuminate\Support\Collection;
// use App\Enums\Stock;

class DeliveryService
{
    public function __construct(
        Delivery $delivery,
        Stock $stock)
    {
        $this->delivery = $delivery;
        $this->stock = $stock;
    }

    /**
     * すべての注文情報を取得する
     *
     * @return Collection
     */
    public function getAllDeliveries(): Collection
    {
        return $this->delivery->getAllDeliveries();
    }

    /**
     * 注文IDから注文情報を取得する
     *
     * @param string $id
     * @return Collection
     */
    public function getDeliveryById(string $id): Collection
    {
        $delivery = $this->delivery->getDeliveryById($id);
        $response = [
            'id' => $delivery[0]['id'],
            'delivery_date' => $delivery[0]['delivery_date'],
            'is_delivered' => $delivery[0]['is_delivered'],
            'quantity' => $delivery[0]['quantity'],
            'created_at' => $delivery[0]['created_at'],
            'updated_at' => $delivery[0]['updated_at'],
            'product_name' => $delivery[0]['product_name'],
            'prefecture' => $delivery[0]['prefecture'],
            'city' => $delivery[0]['city'],
            'address' => $delivery[0]['address'],
            'customer_name' => $delivery[0]['customer_name']
        ];

        return collect($response);
    }

    /**
     * 注文情報を新規作成する
     *
     * @param array $attributes
     * @return boolean|integer
     */
    public function createDelivery(array $attributes): bool|int
    {
        $stock = $this->stock->getStockByProductId($attributes['product_id']);

        // 【TODO】Sweaggerで複数の同じステータスコードのレスポンスの記述がわかるまで一旦コメントアウト
        // if ($stock[0]['quantity'] === Stock::getValue('EMPTY')) return false;
        // if ($stock[0]['quantity'] < $attributes['quantity']) return false;

        return $this->delivery->createDelivery($attributes);
    }

    /**
     * 注文情報を更新する
     *
     * @param array $attributes
     * @return boolean
     */
    public function updateDelivery(array $attributes): bool
    {
        return $this->delivery->updateDelivery($attributes);
    }

    /**
     * 注文情報を削除する
     *
     * @param string $id
     * @return boolean
     */
    public function deleteDelivery(string $id): bool
    {
        return $this->delivery->deleteDelivery($id);
    }
}
