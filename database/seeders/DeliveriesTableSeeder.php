<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class DeliveriesTableSeeder extends Seeder
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
                'delivery_date' => $faker->date(),
                'quantity'      => '5',
                'product_id'    => '1',
                'customer_id'   => '1',
                'is_delivered'  => false
            ],
            [
                'delivery_date' => $faker->date(),
                'quantity'      => '5',
                'product_id'    => '2',
                'customer_id'   => '4',
                'is_delivered'  => false
            ],
            [
                'delivery_date' => $faker->date(),
                'quantity'      => '5',
                'product_id'    => '5',
                'customer_id'   => '2',
                'is_delivered'  => true
            ],
        ];

        Delivery::insert($data);
    }
}
