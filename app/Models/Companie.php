<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];

    public function releases()
    {
        return $this->belongsToMany(Release::class, 'companies_release', 'company_id', 'release_id');
    }
}
