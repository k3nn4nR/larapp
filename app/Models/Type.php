<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['type','brand_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
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
