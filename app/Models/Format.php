<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $primaryKey = 'format_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'size',
        'speed',
        'sides',
        'shape',
        'description',
        'chanels',
        'free_text',
    ];

    public function releases()
    {
        return $this->belongsToMany(Release::class, 'format_release', 'format_id', 'release_id')
        ->withPivot('is_limited');
    }
}
