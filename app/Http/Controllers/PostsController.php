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

        $post = Post::orderBy('created_at', 'desc')->get();

       return view('posts.index',['post'=> $post]);
   }
   //新規投稿
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
    }
    $validate = Validator::make($request->all(), $rulus, $message, );//バリデーションを実行

    if ($validate->fails()) {
        return redirect('/top')
        // エラーを返すか、エラーとともにリダイレクトする
        -> withInput() // セッション()に入力値すべてを入れる
        ->withErrors($validate); // セッション(errors)にエラーの情報を入れる　

    }else{
    $post = $request->input('post'); //新規投稿保存 textareaのname属性でどこに保存するか
    $user_id =Auth::user()->id;

    Post::create([
        'user_id' => $user_id,
        'post' => $post,

    ]);
    return redirect('/top');
   }
   }
//編集機能　表示入力
public function updateForm($id)
    {
        $post = Post::where('id', $id)->first();
       return view('post.update-form', ['post'=>$post]);
   }
//編集機能 結果
 public function update (Request $request){
    //1つ目の処理 リクエスト送るPost::where('id', $id)->updateで投稿を更新
    $id = $request->input('id');
   $post = $request->input('post');
   ddd($post);

    Post::where('id', $id)->update([
       'post' => $post,
    ]);
   return redirect('/top');
}
//削除機能
public function delete($id){
    \DB::table('posts') //データーベースの投稿された内容読み込む
    ->where('id', $id) //削除する投稿選ぶ
    ->delete();

    return redirect('/top');
}
}

