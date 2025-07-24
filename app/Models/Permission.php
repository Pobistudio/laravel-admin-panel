<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
     protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    /**
     * The roles that belong to the permission through role_menu_permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_menu_permission', 'permission_id', 'role_id')
                    ->withPivot('menu_id');
    }

    /**
     * The menus that belong to the permission through role_menu_permission.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu_permission', 'permission_id', 'menu_id')
                    ->withPivot('role_id');
    }
}
