<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CategoryType extends Enum implements LocalizedEnum
{
    const VEGETABLE = 1;
    const FISH = 2;
    const RICE = 3;
    const BEEF = 4;
    const CHICKEN = 5;
}
