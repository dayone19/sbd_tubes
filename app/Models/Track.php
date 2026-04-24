<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $primaryKey = 'track_id';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'duration',
        'position',
    ];

    // RELASI TABEL
    public function release()
    {
        return $this->belongsTo(Release::class, 'release_id');
    }
}
