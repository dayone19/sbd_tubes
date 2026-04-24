<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $primaryKey = 'release_id';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'country',
        'release_date',
        'notes',
        'catalog_number',
    ];

    // RELASI TABEL
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_release', 'release_id', 'artist_id'
        )->withPivot('role');
    }

    public function masterAlbum()
    {
        return $this->belongsTo(MasterAlbum::class,  'master_id');
    }

    public function tracks()
    {
        return $this->hasMany(Track::class, 'release_id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'label_release', 'release_id', 'label_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_release', 'release_id', 'genre_id');
    }

    public function styles()
    {
        return $this->belongsToMany(Style::class, 'release_style', 'release_id', 'style_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'release_id');
    }
}
