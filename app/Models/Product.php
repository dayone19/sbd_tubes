<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Release;
use App\Models\CartItem;
use App\Models\TransactionDetail;
use App\Models\Review;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    public $timestamps = false;
    protected $fillable = [
        'seller_id',
        'release_id',
        'price',
        'condition',
        'status',
        'stock',
    ];

    // RELASI TABEL
    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function release()
    {
        return $this->belongsTo(Release::class, 'release_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}
