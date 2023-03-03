<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['item','item_family_id'];

    public function item_family()
    {
        return $this->belongsTo(ItemFamily::class,'item_family_id');
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function codes()
    {
        return $this->morphMany(Code::class, 'codeable');
    }

    public function payments()
    {
        return $this->morphToMany(Payment::class, 'paymentable');
    }
}
