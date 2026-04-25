<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Shipping extends Model
{
    protected $primaryKey = 'shipping_id';
    public $timestamps = false;
    protected $fillable = [
        'transaction_id',
        'address',
        'cost',
        'status',
    ];

    // RELASI TABEL
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
