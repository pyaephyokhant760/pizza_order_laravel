<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_key',
        'device_limit',
        'expires_at'
    ];

    protected $casts = [
        'license_key' => 'encrypted',
        'expires_at' => 'datetime',
    ];
}
