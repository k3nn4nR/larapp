<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['payment_type_id','company_id','currency_id','total'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function payment_type()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function codes()
    {
        return $this->morphedByMany(Code::class, 'paymentable')->withPivot('amount', 'cost');
    }
 
    public function items()
    {
        return $this->morphedByMany(Item::class, 'paymentable')->withPivot('amount', 'cost');
    }

    public function services()
    {
        return $this->morphedByMany(Service::class, 'paymentable')->withPivot('amount', 'cost');
    }
}
