<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Seller extends Model
{
    protected $primaryKey = 'seller_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'store_name',
    ];

    // RELASI TABEL
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
}
