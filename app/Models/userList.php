<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userList extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','product_id','qty','total','order_code'];
}
