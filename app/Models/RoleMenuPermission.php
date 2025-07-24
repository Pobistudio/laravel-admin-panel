<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleMenuPermission extends Pivot
{
    protected $table = 'role_menu_permission';
    protected $keyType = 'string';
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;


    /**
     * Get the role associated with the pivot record.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * Get the menu associated with the pivot record.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    /**
     * Get the permission associated with the pivot record.
     */
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }
}
