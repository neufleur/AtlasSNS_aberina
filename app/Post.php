<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
   protected $fillable = [
        'user_id',
        'post'
    ];
    //1対多のリレーション　Post.phpにUserテーブルの関係を記載　繋ぐための記述　belongsTo(User.phpの場所)は1対多の"多"から見た"1"
    public function User(){
        return $this->belongsTo('App\User');

    }

}
