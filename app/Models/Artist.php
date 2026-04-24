<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $primaryKey = 'artist_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'profile',
        'country',
    ];

    // RELASI TABEL
    public function releases()
    {
        return $this->belongsToMany(Release::class, 'artist_release', 'artist_id', 'release_id'
        )->withPivot('role');
    }
}
