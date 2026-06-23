<?php

namespace App;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role')->withTimestamps();
    }

    public function hasRole(string|Model|int $role): bool
    {
        if ($role instanceof Model)
            return $this->roles()->find($role->id)->exists();
        if (is_string($role))
            return $this->roles()->where('name', '=', $role)->exists();

        return $this->roles()->find($role)->exists();
    }

    public function hasRoles(array $roles): bool
    {
        foreach ($roles as $r) {
            if (! $this->hasRole($r)) return false;
        }

        return true;
    }

    public function hasPermission(string|Model|int $permission): bool
    {
        return $this->roles->flatMap->permissions->any(function ($p) use ($permission) {
            if ($permission instanceof Model) {
                return $p->id = $permission->id;
            }

            if (is_string($permission)) return $p->name === $permission;

            return $p->id = $permission;
        });
    }

    public function hasPermissions(array $permissions): bool
    {
        foreach ($permissions as $p) {
            if (! $this->hasPermission($p)) return false;
        }

        return true;
    }
    public function hasAnyPermission(array $permissions): bool
    {
        return array_any($permissions, fn($p) => $this->hasPermission($p));
    }
}
