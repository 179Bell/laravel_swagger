<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Enums\CategoryType;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Support\Collection;

class InventoryService
{
    public function __construct(Inventory $inventory, Product $product)
    {
        $this->inventory = $inventory;
        $this->product = $product;
    }

    /**
     * すべての製品の在庫情報を取得する
     *
     * @return Collection
     */
    public function getAllProductInventories(): Collection
    {
        $inventories = $this->product->getAllProductInventory();

        foreach ($inventories as $inventory) {
            $response[] = [
                'id' => $inventory['id'],
                'product_name'   => $inventory['product_name'],
                'product_origin' => $inventory['product_origin'],
                'description'    => $inventory['description'],
                'category' => CategoryType::getDescription($inventory['category_id']),
                'price'    => $inventory['price'],
                'quantity' => $inventory['quantity']
            ];
        }

        return collect($response);
    }
}
