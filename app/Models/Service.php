<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
   
    
    protected $fillable = [
        'name',
        'description',
        'default_price',
        'service_type',
        'service_category',
        'document_list'
    ];

    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'partner_service', 'service_id', 'partner_id');
    }
}
