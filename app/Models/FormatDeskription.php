<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormatDeskription extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'format_release_id',
        'description',
    ];  
}
