<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Follow extends Model
{
    //メソッドによる値の登録・書き換えが不可という状態を作成することができる
    protected $fillable = [
       'user_id','follows', 'following_id', 'followed_id',
    ];
}
