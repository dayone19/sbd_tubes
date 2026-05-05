<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContributorsRole extends Model
{
    protected $primaryKey = 'contributor_role_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function contributorReleases()
    {
        return $this->hasMany(CotributorRelease::class, 'contributor_role_id');
    }
}
