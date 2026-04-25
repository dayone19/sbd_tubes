<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';
    public $timestamps = false;
    protected $fillable = [
        'transaction_id',
        'method',
        'status',
    ];

    // RELASI TABEL
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
