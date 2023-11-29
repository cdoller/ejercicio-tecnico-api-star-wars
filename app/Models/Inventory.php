<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey  = 'id';
    protected $connection = 'mysql';
    protected $table = 'inventories';
    protected $fillable = [
        'movement',
        'current_quantity',
        'ship_url',
    ];
}
