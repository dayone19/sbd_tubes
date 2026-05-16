<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompeniesRelease extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'release_id',
        'company_id',
        'role',
    ];

    public function release()
    {
        return $this->belongsTo(Release::class, 'release_id');
    }

    public function companie()
    {
        return $this->belongsTo(Companie::class, 'company_id');
    }
}
