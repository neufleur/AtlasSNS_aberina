<?php
//名前空間：ファイルの居場所を示す
namespace App\Http\Controllers;
//use宣言：中で使うクラスを宣言する
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Follow;
use Illuminate\Http\Request;



class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }

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

//ログインユーザーがフォローしている人数　処理の結果を保存して条件判定に使う時に、Boolean型使う　boolean型とは、trueまたfalseのどちらかのデータが必ず入ることが決まっているデータ型
       public function isFollowing($user_id){
       return (boolean) $this->follows()->where('followed_id', $user_id)->first();

}

//ログインユーザーがフォローされている人数
      public function isFollowed($user_id){
      return (boolean) $this->follows()->where('following_id', $user_id)->first();

      }

      //フォロー機能
      public function follow(User $user){
        $follower = Auth::user();
        $is_Following =$follower->isFollowing($user->id);  //フォローを紐づいているusersテーブルのレコード情報　$followerに格納されているユーザがフォローしている人たちを取得できる

        if($is_Following) //フォローしてなければフォロー
        $follower->follow($user->id);
    return back();
   }
      //フォロー解除
      public function nofollow(User $user){
        $follower = Auth::user();
        $is_Following =$follower->isFollowing($user->id);

        if($is_Following) //フォローしてれば解除
        $follower->nofollow($user->id);
    return back();
   }
}

