<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ja_JP');

        $data = [
            [
                'order_date' => $faker->date(),
                'quantity'      => '5',
                'product_id'    => '1',
                'customer_id'   => '1',
                'is_delivered'  => false
            ],
            [
                'order_date' => $faker->date(),
                'quantity'      => '5',
                'product_id'    => '2',
                'customer_id'   => '4',
                'is_delivered'  => false
            ],
            [
                'order_date' => $faker->date(),
                'quantity'      => '5',
                'product_id'    => '5',
                'customer_id'   => '2',
                'is_delivered'  => true
            ],
        ];

        Delivery::insert($data);
    }
}
