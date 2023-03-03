<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemFamily extends Model
{
    use HasFactory, SoftDeletes;
    protected $ffillable = ['item_familiy'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
}
