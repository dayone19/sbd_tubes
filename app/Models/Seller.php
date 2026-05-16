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

    public function reviews()
{
    // Mengambil ulasan lewat perantara produk yang dijual oleh seller ini
    return $this->hasManyThrough(
        Review::class,    // Model tujuan akhir (Review)
        Product::class,   // Model perantara (Product)
        'seller_id',      // Foreign key di tabel products (menghubungkan Seller ke Product)
        'product_id',     // Foreign key di tabel reviews (menghubungkan Product ke Review)
        'seller_id',      // Local key di tabel sellers
        'product_id'      // Local key di tabel products
    );
}
}
