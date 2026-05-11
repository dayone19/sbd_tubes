<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{
    protected $table = 'lists';
    protected $primaryKey = 'list_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
