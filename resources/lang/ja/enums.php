<?php

declare(strict_types=1);

use App\Enums\CategoryType;

return [
    CategoryType::class => [
        CategoryType::VEGETABLE => '野菜類',
        CategoryType::FISH      => '魚類',
        CategoryType::RICE      => '米',
        CategoryType::BEEF      => '牛肉',
        CategoryType::CHICKEN   => '鶏肉'
    ],
];
