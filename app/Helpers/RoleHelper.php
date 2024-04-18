<?php

namespace App\Helpers;


use JetBrains\PhpStorm\Pure;

class RoleHelper
{
    public const ROLE_ADMIN = 20;
    public const ROLE_SUPER_ADMIN = 21;

    public static array $roles = [
        self::ROLE_ADMIN => 'Админ',
        self::ROLE_SUPER_ADMIN => 'Суперадмин',
    ];

    public static function rolesList(): array
    {
        return self::$roles;
    }

    #[Pure]
    public static function getRoleName($role = null): string
    {
        if (!empty(self::rolesList()[$role])) {
            return self::rolesList()[$role];
        }
        return '';
    }
}
