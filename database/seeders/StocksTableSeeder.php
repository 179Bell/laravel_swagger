<?php

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'quantity'   => 20,
                'product_id' => 1
            ],
            [
                'quantity'   => 20,
                'product_id' => 2
            ],
            [
                'quantity'   => 20,
                'product_id' => 3
            ],
            [
                'quantity'   => 20,
                'product_id' => 4
            ],
            [
                'quantity'   => 20,
                'product_id' => 5
            ]
        ];

        Stock::insert($params);
    }
}
