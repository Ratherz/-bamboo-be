<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Post extends Model
{
    protected $table = 'user_post';
    public $timestamps = false;
    protected $fillable  = ['user_id','post_id'];
}
