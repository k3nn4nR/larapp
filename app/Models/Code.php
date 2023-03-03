<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Code extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['code', 'codeable_id', 'codeable_type'];

    public function codeable()
    {
        return $this->morphTo();
    }

    public function payments()
    {
        return $this->morphToMany(Payment::class, 'paymentable');
    }
}
