<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'release_id',
        'type',
        'description',
        'value',
        'created_at',
        'update_at',
    ];

    public function release()
    {
        return $this->belongsTo(Release::class, 'release_id');
    }

}
