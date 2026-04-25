<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Riview extends Model
{
    protected $primaryKey = 'review_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
    ];

    // RELASI TABEL
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
