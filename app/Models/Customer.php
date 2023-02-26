<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * すべての顧客情報を取得する
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Customer::all();
    }
}
