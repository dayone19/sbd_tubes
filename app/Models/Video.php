<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $primaryKey = 'video_id';
    public $timestamps = false;
    protected $fillable = [
        'release_id',
        'title',
        'youtube_url',
        'thumbnail',
        'duration',
    ];

    public function releases()
    {
        return $this->hasMany(Release::class, 'release_id');
    }
}
