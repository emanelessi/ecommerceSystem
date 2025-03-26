<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class ProductImage extends Model
{
    use  HasFactory, softDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
