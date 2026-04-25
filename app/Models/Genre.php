<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Release;

class Genre extends Model
{
    protected $primaryKey = 'genre_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    // RELASI TABEL
    public function releases()
    {
        return $this->belongsToMany(Release::class, 'genre_release', 'genre_id', 'release_id');
    }
}
