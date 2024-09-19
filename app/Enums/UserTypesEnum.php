<?php

namespace App\Enums;

final class UserTypesEnum{

     const ADMIN = 'admin';
     const USER = 'user';

    public static $USER_TYPES =
        [
            self::ADMIN,
            self::USER,
        ];
}
