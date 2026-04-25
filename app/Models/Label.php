<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Release;

class Label extends Model
{
    protected $primaryKey = 'label_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    // RELASI TABEL
    public function releases()
    {
        return $this->belongsToMany(Release::class, 'label_release', 'label_id', 'release_id');
    }
}
