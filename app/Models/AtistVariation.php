<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtistVariation extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'artist_id',
        'variation_name',
    ];

    // RELASI TABEL
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
