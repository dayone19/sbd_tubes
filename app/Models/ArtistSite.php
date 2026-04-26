<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArtistSite extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'artist_id',
        'type',
        'url',
    ];

    // RELASI TABEL
    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
