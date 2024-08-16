<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
//use宣言がないとclassエラーが起こる

class UsersController extends Controller
{
    //
    public function profile(){
    $auth = Auth::user();

        return view('users.profile', ['auth'=>$auth]);

    }

    //検索機能の実装
    public function search(Request $request){
        //ユーザーテーブルから全てのレコードを取得する↓
        $users = User::get();
        $users = DB::table('users')->get();
        $keyword = $request->input('keyword'); //キーワードを取得
            if(!empty($keyword)){
            $users->where('username','LIKE',"%" . $keyword . "%");
        }
        return view('users.search', compact('users','keyword'));
    }

}
// $users = Auth::user();今ログインしている人のユーザーを取得　
// $request入力された値を$keywordに格納→$keywordで何かしらの値を受け取った場合は、if文の中で取得するデータを絞りこむ
// =>添字にあたる'users'部分（キー）を文字列で指定
//compact関数とはコントローラで受け取った値をビューへ受け渡す
//