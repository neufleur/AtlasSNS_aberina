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

     //フォロー　中間テーブルと繋げる　
     public function follows(){

        return $this->belongsToMany('App\User','follows', 'following_id', 'followed_id');
        //return $this->belongsToMany('⓵followersの場所', '⓶中間テーブル', '⓷自分のidが入る' ④相手モデルに関係しているid);
        }
//フォロワー
       public function followers(){

        return $this->belongsToMany('App\User','follows', 'following_id', 'followed_id');
        //return $this->belongsToMany('⓵followersの場所', '⓶中間テーブル', '⓷自分のidが入る' ④相手モデルに関係しているid);
   }
}
