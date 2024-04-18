<?php

namespace App\Traits;

use App\Helpers\RoleHelper as Roles;
use Illuminate\Database\Eloquent\Collection;

trait HasRole
{
    public function hasRole(?int $roleId) : bool
    {
        return $this->role == $roleId || $this->isSuperAdmin();
    }

    public function isSuperAdmin(): bool
    {
        return $this->role == Roles::ROLE_SUPER_ADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role == Roles::ROLE_ADMIN || $this->isSuperAdmin();
    }

    public static function getSuperAdmins(): Collection
    {
        return self::where('role', Roles::ROLE_SUPER_ADMIN)->get();
    }

    public static function getAllAdmins(): Collection
    {
        return self::whereIn('role', [Roles::ROLE_SUPER_ADMIN, Roles::ROLE_ADMIN])->get();
    }
}
