<?php

namespace App\Models;
use App\Models\Release;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'image_id';
    public $timestamps = false;
    protected $fillable = [
        'release_id',
        'url',
        'type',
    ];

    // RELASI TABEL
    public function release()
    {
        return $this->belongsTo(Release::class, 'release_id');
    }
}
