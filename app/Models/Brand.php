<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $ffillable = ['brand'];

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function codes()
    {
        return $this->morphMany(Code::class, 'codeable');
    }
}
