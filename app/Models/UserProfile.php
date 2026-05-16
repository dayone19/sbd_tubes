<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $primaryKey = 'user_profile_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'image',
        'real_name',
        'profile',
        'geographic_location',
        'home_page',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
