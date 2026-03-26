<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $fillable = [
        'order_date', 'partner_id', 'partnername', 'amount_total',
        'invoice_status', 'order_number', 'user_id'
    ];

   
    public function details()
    {
        return $this->hasMany(Detail::class, 'order_id');
    }
    


    protected $table = 'orders'; 


}