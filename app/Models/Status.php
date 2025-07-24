<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    protected $table = "statuses";
    protected $primaryKey = "id";
    protected $keyType = "string";
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'status_id', 'id');
    }
}
