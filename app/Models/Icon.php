<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = "icons";
    protected $primaryKey = "id";
    protected $keyType = "string";
    protected $guarded = [];
    public $timestamps = false;
    public $incrementing = false;
}
