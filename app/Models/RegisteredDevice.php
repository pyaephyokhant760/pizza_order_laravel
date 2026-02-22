<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredDevice extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_id',
        'fingerprint'
    ];
    public function license()
    {
        return $this->belongsTo(License::class, 'license_id');
    }
    
}
