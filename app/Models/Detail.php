<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
   
    protected $table = 'order_details';  

    protected $fillable = [
        'order_id',
        'service_id',
        'quantity',
        'price',
        'total',
        'remarks',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    
}
