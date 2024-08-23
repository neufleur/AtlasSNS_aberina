<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\PDO;
use Illuminate\Support\Facades\DB;
//use宣言がないとclassエラーが起こる

class UsersController extends Controller
{
    //
    public function profile(Request $request){
       $auth = Auth::user();

    return view('users.profile', ['auth'=>$auth]);
}

public function updateProfile(Request $request){

    //inputで保存
       $id = $request->input('id');
       $username = $request->input('username');
       $mail = $request->input('mail');
       $password = $request->input('password');
       $bio = $request->input('bio');
       //dd($request->file('images'));
       //画像登録 if文で画像必須をなくす なければそのままに
       if(!empty($request->file('images'))) {
        $images = $request->file('images')->getClientOriginalName(); //ファイルにimages送る getClientOriginalName アップロードされたファイル名を取得
        //dd($images);
        $request->file('images')->storeAs('public/images',$images); //storeAsメソッドを使用することで保存するファイル名を指定できる
       }

       //updateで更新　テーブルから取得したいユーザーを決める条件として、where句での条件にこの$id変数が設定されている
       User::where('id', $id)->update([
         'username' => $username,
         'mail' => $mail,
         'password' => $password,
         'bio' => $bio,
         'images' => $images,
   ]);

    $validated = $request->validate([
       'username' => 'required|min:2|max:12',
       'mail' => 'required|email|min:5|max:40|unique:users,mail',
       'password' => 'required|alpha_num|min:8|max:20|confirmed',
       'bio' => 'string|max:150',
       'image'=>'File|mimes:jpg,png,bmp,gif,svg',
      ]);

    //}
 return redirect('/top'); //view()はWebページのアクセス時などのGET処理時 redirect()はフォーム送信などのPOST
}



    //検索機能の実装
    public function search(Request $request){
        //ユーザーテーブルから全てのレコードを取得する↓
        $users = User::get();
        $keyword = $request->input('keyword'); //キーワードを取得
        if(!empty($keyword)){
           $users = User::where('username','LIKE',"%" . $keyword . "%")->get();
            } //User:: User::モデルを介してユーザーズテーブルにアクセスができる　
        //$result = $users->fetchAll(PDO::FETCH_ASSOC); // 結果セットに残っている全ての行を含む配列を返す　取得結果がゼロ件だった場合は空の配列を返す
        return view('users.search', compact('users','keyword'));
    }

}

// $users = Auth::user();今ログインしている人のユーザーを取得　
// $request入力された値を$keywordに格納→$keywordで何かしらの値を受け取った場合は、if文の中で取得するデータを絞りこむ
// =>添字にあたる'users'部分（キー）を文字列で指定
//compact関数とはコントローラで受け取った値をビューへ受け渡す
//