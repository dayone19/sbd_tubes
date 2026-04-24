<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $primaryKey = 'style_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    // RELASI TABEL
    public function releases() 
    {
        return $this->belongsToMany(Release::class, 'release_style' ,'style_id', 'release_id');
    }
}
