<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Follow extends Model
{
    //
    protected $fillable = [
       'user_id','follows', 'following_id', 'followed_id',
    ];
}
