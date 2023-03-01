<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Delivery;
use Illuminate\Support\Collection;

class DeliveryService
{
    public function __construct(Delivery $delivery)
    {
        $this->delivery = $delivery;
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
}
