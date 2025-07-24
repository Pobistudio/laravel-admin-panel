<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $table = "roles";
    protected $primaryKey = "id";
    protected $keyType = "string";
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    /**
     * Get the users associated with the role.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    /**
     * The menus that belong to the role through role_menu_permission.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu_permission', 'role_id', 'menu_id')
                    ->withPivot('permission_id')
                    ->using(RoleMenuPermission::class);
    }

    /**
     * The permissions that belong to the role through role_menu_permission.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_menu_permission', 'role_id', 'permission_id')
                    ->withPivot('menu_id');
    }
}
