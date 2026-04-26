<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Release;

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

    public function artistSites()
    {
        return $this->hasMany(ArtistSites::class, 'artist_id');
    }

    public function artistVariations()
    {
        return $this->hasMany(ArtistVariation::class, 'artist_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'id', 'artist_id', 'group_id');
    }
}
