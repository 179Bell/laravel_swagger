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

    /**
     * 顧客IDから顧客情報を検索する
     *
     * @param string $id 顧客ID
     * @return Collection
     */
    public function getCustomerById(string $id): Collection
    {
        return $this->customer->getCustomerById($id);
    }

    /**
     * 顧客情報を新規作成する
     *
     * @param array $attributes
     * @return boolean
     */
    public function createCustomer(array $attributes): bool
    {
        return $this->customer->createCustomer($attributes);
    }
}
