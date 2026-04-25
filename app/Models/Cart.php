<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CartItem;

class Cart extends Model
{
    protected $primaryKey = 'cart_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
    ];

    //RELASI TABEL
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
