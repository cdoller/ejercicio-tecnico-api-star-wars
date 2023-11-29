<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ship extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey  = 'url';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $connection = 'mysql';
    protected $table = 'ships';
    protected $fillable = [
        'url',
        'ship_type',
    ];
}
