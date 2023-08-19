<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'apartment_id',
        'email',
        'contact',
        'occupantsQty',
        'start_date'
    ];
    
    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
