<?php

namespace Database\Seeders;

use App\Enums\CategoryType;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'product_name'   => 'ブロッコリー',
                'product_origin' => '北海道',
                'description'    => 'トレーニー大好きみんなブロッコリー',
                'category_id'    => CategoryType::getValue('VEGETABLE'),
                'price'          => '100'
            ],
            [
                'product_name'   => 'あんこう',
                'product_origin' => '茨城',
                'description'    => 'あんこう鍋美味しいよね',
                'category_id'    => CategoryType::getValue('FISH'),
                'price'          => '1000'
            ],
            [
                'product_name'   => 'あいちのかおり',
                'product_origin' => '愛知',
                'description'    => '愛知もお米美味しいよ？？',
                'category_id'    => CategoryType::getValue('VEGETABLE'),
                'price'          => '1000'
            ],
            [
                'product_name'   => '神戸牛',
                'product_origin' => '兵庫',
                'description'    => '美味しい神戸ビーフ',
                'category_id'    => CategoryType::getValue('BEEF'),
                'price'          => '3000'
            ],
            [
                'product_name'   => '名古屋コーチン',
                'product_origin' => '愛知',
                'description'    => '愛知がほこるブランド',
                'category_id'    => CategoryType::getValue('CHICKEN'),
                'price'          => '1980'
            ]
        );
    }
}
