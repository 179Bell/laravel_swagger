<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Delivery;
use Illuminate\Database\Eloquent\Collection;

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
}
