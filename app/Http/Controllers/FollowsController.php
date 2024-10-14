<?php
//名前空間：ファイルの居場所を示す
namespace App\Http\Controllers;

//use宣言：中で使うクラスを宣言する
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Follow;



class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
    //public function 関数(引数)引数　とは関数に渡して処理の中でその値を使うことができるもの

      //フォロー機能
      public function Follow(User $users){
        dd($users);

        $follower = Auth::user();
        $is_Following =$follower->isFollowing($users->id);  //フォローを紐づいているusersテーブルのレコード情報　$followerに格納されているユーザがフォローしている人たちを取得できる

        if($is_Following){//フォローしてなければフォロー
        $follower->Follow($users->id);
        }
        return back();
   }
      //フォロー解除
      public function unFollow(User $users){
        $follower = Auth::user();
        $is_Following =$follower->isFollowing($users->id);

        if($is_Following){
            //フォローしてれば解除
        $follower->unFollow($users->id);
        return back();
        }
    }
}

