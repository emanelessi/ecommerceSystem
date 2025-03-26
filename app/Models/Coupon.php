<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Coupon extends Model
{
    use HasFactory,  softDeletes;

    protected $guarded = [];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_product');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
