<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
        'password_confirmation',
        'images'
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //リレーションはモデル(~~.php)に記入する　コントローラーは画面にreturnで表示させる部分　

    //フォロー　中間テーブルと繋げる　
    public function follows(){

        return $this->belongsToMany('App\User','follows', 'following_id', 'followed_id');
        //return $this->belongsToMany('⓵followersの場所', '⓶中間テーブル', '⓷自分のidが入る' ④相手モデルに関係しているid);
        }
//フォロワー
       public function followers(){

        return $this->belongsToMany('App\User','follows', 'followed_id', 'following_id');
        //return $this->belongsToMany('⓵followersの場所', '⓶中間テーブル', '⓷自分のidが入る' ④相手モデルに関係しているid);
   }

//ログインユーザーがフォローしている　処理の結果を保存して条件判定に使う時に、Boolean型使う　boolean型とは、trueまたfalseのどちらかのデータが必ず入ることが決まっているデータ型
       public function isFollowing($user_id){
       return (boolean) $this->follows()->where('followed_id', $user_id)->first();

}

//ログインユーザーがフォローされている
      public function isFollowed($user_id){
      return (boolean) $this->follows()->where('following_id', $user_id)->first();

      }
      //Followの定義　attach繋げる
      public function Follow($user_id){
        return $this->follows()->attach($user_id);

    }
    //unFollowの定義 detach解除
    public function unFollow($user_id){
        return $this->follows()->detach($user_id);

    }
//1対多のリレーション　User.phpにPostテーブルの関係はこういうものですよと繋ぐための記述　hasMany(Post.phpの場所)は1対多の"1"から見た"多"
    public function Posts(){
        return $this->hasMany('App\Post');

    }

}
