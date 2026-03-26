<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    // Table name (since Laravel would assume plural form otherwise)
    protected $table = 'partners';

    // Primary key
    protected $primaryKey = 'id';

    // If your table doesn't use auto-increment or different PK
    public $incrementing = true;

    // Primary key type
    protected $keyType = 'int';

    // Disable Laravel's timestamps if table uses custom ones
    public $timestamps = true;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'company_id',
        'comment',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'title',
        'email',
        'phone',
        'tax_code',
        'party_type',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
