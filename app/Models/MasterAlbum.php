<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Release;

class MasterAlbum extends Model
{
    protected $primaryKey = 'master_id';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'year',
    ];

    // RELASI TABEL
    public function releases()
    {
        return $this->hasMany(Release::class, 'master_id');
    }
}
