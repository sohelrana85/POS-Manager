<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;
    protected $fillable = [
            'user',
            'business_name',
            'start_date',
            'logo',
            'currency',
            'currency_symbol',
            'date_format',
            'time_format',
            'address',
            'country',
            'city',
            'mobile',
            'email',
            'website',
    ];
}
