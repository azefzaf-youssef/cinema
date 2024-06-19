<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserPermission extends Enum
{
    const Administrateur = 777;
    const ConnectedUser = 1;
}
