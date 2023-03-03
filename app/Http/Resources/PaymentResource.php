<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $details = collect([]);
        if($this->codes){
            foreach(CodePaymentResource::collection($this->codes) as $element)
            {
                $details->push($element);
            }
        }
        if($this->services){
            foreach(ServicePaymentResource::collection($this->services) as $element)
            {
                $details->push($element);
            }
        }
        if($this->items){
            foreach(ItemPaymentResource::collection($this->items) as $element)
            {
                $details->push($element);
            }
        }
        return [
            'company'=> $this->company->company,
            'type'=> $this->payment_type->payment_type,
            'total' => $this->total,
            'currency'=> $this->currency->currency,
            'datetime'=> Carbon::parse($this->created_at)->isoFormat('dddd, MMMM Do YYYY, h:mm'),
            'details' => $details,
        ];
    }
}
