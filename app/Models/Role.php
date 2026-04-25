<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    protected $primaryKey = 'role_id';
    public $timestamps = false;
    protected $fillable = [
        'role',
    ];

    // RELASI TABEL
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }

}
