<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TransactionDetail;
use App\Models\Payment;
use App\Models\Shipping;

class Transaction extends Model
{
    protected $primaryKey = 'transaction_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // RELASI TABEL
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'transaction_id');
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class, 'transaction_id');
    }
}
