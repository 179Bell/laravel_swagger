<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefecture',
        'city',
        'address',
        'customer_name',
    ];

    /**
     * すべての顧客情報を取得する
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Customer::all();
    }

    /**
     * 顧客IDから顧客情報を取得する
     *
     * @param string $id 顧客ID
     * @return Collection
     */
    public function getCustomerById(string $id): Collection
    {
        return Customer::where('id', $id)->get();
    }

    /**
     * 顧客情報を新規作成する
     *
     * @param array $attributes
     * @return boolean
     */
    public function createCustomer(array $attributes): bool
    {
        return Customer::fill($attributes)->save();
    }

    /**
     * 顧客情報を更新する
     *
     * @param array $attributes
     * @return boolean
     */
    public function updateCustomer(array $attributes): bool
    {
        $customer = Customer::find($attributes['id']);
        return $customer->fill($attributes)->save();
    }

    /**
     * 顧客情報を削除する
     *
     * @param string $id 顧客ID
     * @return boolean
     */
    public function deleteCustomer(string $id): bool
    {
        return Customer::find($id)->delete();
    }
}
