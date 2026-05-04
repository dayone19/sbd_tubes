<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $primaryKey = 'format_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function releases()
    {
        return $this->belongsToMany(Release::class, 'format_release', 'format_id', 'release_id');
    }
}
