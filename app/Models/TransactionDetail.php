<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Product;

class TransactionDetail extends Model
{
    protected $primaryKey = 'detail_id';
    public $timestamps = false;
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price',
    ];

    // RELASI TABEL
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
