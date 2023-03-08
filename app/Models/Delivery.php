<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_date',
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
    public function getAllDeliveries(): Collection
    {
        return Delivery::all();
    }

    /**
     * 注文IDから注文情報を取得する
     *
     * @param string $id
     * @return Collection
     */
    public function getDeliveryById(string $id): Collection
    {
        return Delivery::join('products', 'deliveries.product_id', '=', 'products.id')
                ->join('customers', 'deliveries.customer_id', '=', 'customers.id')
                ->where('deliveries.id', $id)
                ->get();
    }

    /**
     * 注文情報を新規登録する
     *
     * @param array $attributes
     * @return boolean
     */
    public function createDelivery(array $attributes): bool
    {
        return Delivery::fill($attributes)->save();
    }
}
