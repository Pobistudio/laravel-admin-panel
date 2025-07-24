<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = true;

    /**
     * Get the parent menu.
     */
    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent', 'id');
    }

    /**
     * Get the child menus.
     */
    public function childMenus()
    {
        return $this->hasMany(Menu::class, 'parent', 'id');
    }

    /**
     * The roles that belong to the menu through role_menu_permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_menu_permission', 'menu_id', 'role_id')
                    ->withPivot('permission_id');
    }

    /**
     * The permissions that belong to the menu through role_menu_permission.
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_menu_permission', 'menu_id', 'permission_id')
                    ->withPivot('role_id');
    }
}
