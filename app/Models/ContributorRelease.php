<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContributorRelease extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'release_id',
        'user_id',
        'contributor_role_id',
        'created_at',
    ];

    public function contributorsRole()
    {
        return $this->belongsTo(ContributorRole::class, 'contributor_role_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function release()
    {
        return $this->belongsTo(Release::class, 'release_id', 'release_id');
    }
}
