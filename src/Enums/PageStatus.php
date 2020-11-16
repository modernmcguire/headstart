<?php

namespace ModernMcGuire\Headstart\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PageStatus extends Enum
{
    const Draft = 'draft';
    const Published = 'published';
}
