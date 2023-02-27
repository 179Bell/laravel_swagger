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
     * すべての注文情報を取得する
     *
     * @return DeliveryResource
     */
    public function getAllDeliveries(): DeliveryResource
    {
        $deliveries = $this->service->getAllDeliveries();
        return new DeliveryResource($deliveries);
    }
}
