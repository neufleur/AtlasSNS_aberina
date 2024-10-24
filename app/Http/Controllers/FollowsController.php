<?php
//名前空間：ファイルの居場所を示す
namespace App\Http\Controllers;

//use宣言：中で使うクラスを宣言する
use App\Http\Controllers\Controller;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Follow;


class FollowsController extends Controller
{

    public function followList(Post $post, User $user, Follow $follow){
        // フォローしているユーザーのidを取得 pluck()メソッドの中には今回取得したい情報のカラム名
        $following_id = Auth::user()->follows()->pluck('followed_id');
        // フォローしているユーザーのidを元に投稿内容を取得
        $post = Post::whereIn('user_id', $following_id)->orderBy('created_at', 'desc')->get();
          // フォローしているユーザーの情報を取得
        $users = User::whereIn('id', $following_id)->get();
        //dd($post);
        $images = Auth::user()->follows()->get();
        //dd($images);
          return view('follows.followList',compact('post','images'));
        }


public function followerList(Post $post, User $user, Follow $follow){
    // フォローされてるユーザーのidを取得
    $followed_id = Auth::user()->followers()->pluck('following_id');
    //dd($followed_id);
    // フォローされてるユーザーのidを元に投稿内容を取得
    $post = Post::whereIn('user_id', $followed_id)->orderBy('created_at', 'desc')->get();
   //dd($post);
      // フォローされてるユーザーの情報を取得
    $users = User::whereIn('id', $followed_id)->get();
    //dd($users);
    $images = Auth::user()->followers()->get();
   // dd($images);
      return view('follows.followerList',compact('post','images'));

}

public function followsProfile (){
    $users = User::get();
    return view('/profile-users');
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

