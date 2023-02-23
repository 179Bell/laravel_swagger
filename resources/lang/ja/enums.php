<?php

declare(strict_types=1);

use App\Enums\CategoryType;

return [
    CategoryType::class => [
        CategoryType::VEGETABLE => '野菜類',
        CategoryType::FISH      => '魚類',
        CategoryType::CLOTH     => '衣類',
        CategoryType::TOOL      => '工具類',
        CategoryType::APPLIANCE => '家電類'
    ],
];
