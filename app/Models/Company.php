<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'email','create_date', 'phone', 'address', 'tax_code'];
     
     public function partners()
    {
        return $this->hasMany(Partner::class, 'company_id');
    }

}
