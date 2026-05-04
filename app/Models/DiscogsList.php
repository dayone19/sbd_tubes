<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscogsList extends Model
{
    protected $primaryKey = 'list_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'name',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function releases()
    {
        return $this->belongsToMany(Release::class, 'list_release', 'list_id', 'release_id');
    }
}
