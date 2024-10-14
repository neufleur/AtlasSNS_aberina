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
            // フォローしているユーザーのidを取得
              $following_id = Auth::user()->follows()->pluck('followed_id');

            // フォローしているユーザーのidを元に投稿内容を取得
              $followings = Post::with('user')->whereIn('id', $following_id)->get();
              return redirect('/followsList' ,compact('followings'));
            }


    public function followerList(){
        return view('follows.followerList');
    }





    //public function 関数(引数)引数　とは関数に渡して処理の中でその値を使うことができるもの (User $user)一致させないとだめ
      //フォロー機能
      public function Follow(User $user){
        //dd($user);
        $follower = Auth::user();
        $is_Following =$follower->isFollowing($user->id);  //フォローを紐づいているusersテーブルのレコード情報　$followerに格納されているユーザがフォローしている人たちを取得できる

        if(!$is_Following){
            //フォローしてなければフォロー !マークでフォローしていなければの表示
            //dd($is_Following);
        $follower->Follow($user->id);
        }
        return back();
   }
      //フォロー解除
      public function unFollow(User $user){
        $follower = Auth::user();
        $is_Following =$follower->isFollowing($user->id);

        if($is_Following){
            //フォローしてれば解除
        $follower->unFollow($user->id);
        }
        return back();
    }
}

