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

    $post = $request->input('newPost'); //新規投稿保存
    $user_id =Auth::user()->id;

    Post::create([
        'user_id' => $user_id,
        'newPost' => $post,

    ]);

    return redirect('/top');
   }

}
