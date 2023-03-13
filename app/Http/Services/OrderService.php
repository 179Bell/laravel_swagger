<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Order;
use App\Models\Stock;
use Illuminate\Support\Collection;
// use App\Enums\Stock;

class OrderService
{
    public function __construct(
        Order $order,
        Stock $stock)
    {
        $this->delivery = $order;
        $this->stock = $stock;
    }

    /**
     * すべての注文情報を取得する
     *
     * @return Collection
     */
    public function getAllOrders(): Collection
    {
        return $this->delivery->getAllOrders();
    }

    /**
     * 注文IDから注文情報を取得する
     *
     * @param string $id
     * @return Collection
     */
    public function getOrderById(string $id): Collection
    {
        $order = $this->delivery->getOrderById($id);
        $response = [
            'id' => $order[0]['id'],
            'order_date' => $order[0]['order_date'],
            'is_delivered' => $order[0]['is_delivered'],
            'quantity' => $order[0]['quantity'],
            'created_at' => $order[0]['created_at'],
            'updated_at' => $order[0]['updated_at'],
            'product_name' => $order[0]['product_name'],
            'prefecture' => $order[0]['prefecture'],
            'city' => $order[0]['city'],
            'address' => $order[0]['address'],
            'customer_name' => $order[0]['customer_name']
        ];

        return collect($response);
    }

    /**
     * 注文情報を新規作成する
     *
     * @param array $attributes
     * @return boolean|integer
     */
    public function createOrder(array $attributes): bool|int
    {
        $stock = $this->stock->getStockByProductId($attributes['product_id']);

        // 【TODO】Sweaggerで複数の同じステータスコードのレスポンスの記述がわかるまで一旦コメントアウト
        // if ($stock[0]['quantity'] === Stock::getValue('EMPTY')) return false;
        // if ($stock[0]['quantity'] < $attributes['quantity']) return false;

        return $this->delivery->createOrder($attributes);
    }

    /**
     * 注文情報を更新する
     *
     * @param array $attributes
     * @return boolean
     */
    public function updateOrder(array $attributes): bool
    {
        return $this->delivery->updateOrder($attributes);
    }

    /**
     * 注文情報を削除する
     *
     * @param string $id
     * @return boolean
     */
    public function deleteOrder(string $id): bool
    {
        return $this->delivery->deleteOrder($id);
    }
}
