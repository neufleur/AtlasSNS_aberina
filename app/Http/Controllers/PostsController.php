<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Post;


class PostsController extends Controller
{
    //投稿表示
    public function index(){
        $users = Post::get();

       return view('posts.index');
   }

   public function create(Request $request){

    if($request->isMethod('post')){
        $rulus = [
            'post' => 'required|min:1|max:150',
        ];
        $message = [
            'post.required'=>'投稿内容は入力必須です',
            'post.min' => '1文字以上で入力してください',
            'post.max' =>'150文字以下で入力してください',
        ];
        $validate = Validator::make($request->all(), $rulus, $message, );//バリデーションを実行
    }
    if ($validate->fails()) {
        return redirect('/top')
        // エラーを返すか、エラーとともにリダイレクトする
        -> withInput() // セッション()に入力値すべてを入れる
        ->withErrors($validate); // セッション(errors)にエラーの情報を入れる　

    }else{
    $post = $request->input('post'); //新規投稿保存
    $user_id =Auth::user()->id;

    Post::create([
        'user_id' => $user_id,
        'post' => $post,

    ]);

    return redirect('/top');
   }
   }

}

