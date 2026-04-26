<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $primaryKey = 'group_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    // RELASI TABEL
    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'id', 'group_id', 'artist_id');
    }
}
