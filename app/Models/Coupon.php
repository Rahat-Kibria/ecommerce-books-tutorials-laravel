<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'slug', 'expiry_date', 'discount', 'created_at', 'updated_at'];
    protected $table = 'coupons';
}
