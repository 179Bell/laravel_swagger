<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * 在庫に関するEnumClass
 */
final class Stock extends Enum
{
    const EMPTY = '0';
    /**
     * @var string 指定された商品の在庫がないの場合
     */
    const STOCK_EMPTY = 2;
    /**
     * @var string 在庫量がリクエストを下回っている場合
     */
    const STOCK_SHORTAGE = 3;
}
