<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'quantity',
        'product_id',
        'customer_id',
        'is_delivered',
    ];

    /**
     * すべての注文情報を取得する
     *
     * @return Collection
     */
    public function getAllOrders(): Collection
    {
        return Order::all();
    }

    /**
     * 注文IDから注文情報を取得する
     *
     * @param string $id
     * @return Collection
     */
    public function getOrderById(string $id): Collection
    {
        return Order::join('products', 'orders.product_id', '=', 'products.id')
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->where('orders.id', $id)
                ->get();
    }

    /**
     * 注文情報を新規登録する
     *
     * @param array $attributes
     * @return boolean
     */
    public function createOrder(array $attributes): bool
    {
        return Order::fill($attributes)->save();
    }

    /**
     * 注文情報を更新する
     *
     * @param array $attributes
     * @return boolean
     */
    public function updateOrder(array $attributes): bool
    {
        $deliveryId = $attributes['id'];

        $params = [
            'order_date' => $attributes['order_date'],
            'quantity'      => $attributes['quantity'],
            'product_id'    => $attributes['product_id'],
            'customer_id'   => $attributes['customer_id']
        ];

        return Order::find($deliveryId)->fill($params)->save();
    }

    /**
     * 注文情報を削除する
     *
     * @param string $id
     * @return boolean
     */
    public function deleteOrder(string $id): bool
    {
        return Order::find($id)->delete();
    }
}
