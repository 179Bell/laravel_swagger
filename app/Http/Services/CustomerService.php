<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * すべての顧客情報を取得する
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->customer->getAll();
    }
}
