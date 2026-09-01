<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class District extends Model
{
    protected $fillable = ['name', 'province', 'delivery_charge', 'is_active'];

    protected $casts = [
        'delivery_charge' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}