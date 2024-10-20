<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
//use宣言がないとclassエラーが起こる

class UsersController extends Controller
{
    //public function 関数(引数)引数　とは関数に渡して処理の中でその値を使うことができるもの
    public function profile(Request $request){
       $auth = Auth::user();

    return view('users.profile', ['auth'=>$auth]);
}

public function updateProfile(Request $request){

        if($request->isMethod('post')){
            $rulus = [
                'username' => 'required|min:2|max:12',
                'mail' => 'required','email','min:5','max:40',Rule::unique('users')->ignore($request->user_id, 'user_id'),
                'password' => 'required|alpha_num|min:8|max:20|confirmed|string',
                'bio' => 'string|max:150|nullable',
               'images'=>'image|File|mimes:jpg,png,bmp,gif,svg||nullable',
               //Rule::unique('テーブル名')->ignore(主キー, '主キーのカラム名')
               //String 文字列が特定の条件を満たしているかどうかを確認する機能
            ];
            $message = [
            'username.required' =>'ユーザー名は入力必須です',
            'username.min' => 'ユーザー名は2文字以上、12文字以下で入力してください',
            'username.max' =>'ユーザー名は2文字以上、12文字以下で入力してください',
            'mail.required' =>'メールアドレスは入力必須です',
            'mail.email' =>'有効なメールアドレスを入力してください',
            'mail.unique:users,mail' =>'このメールアドレスは既に使われています',
            'mail.min' => 'メールアドレスは5文字以上、40文字以下で入力してください',
            'mail.max' =>'メールアドレスは5文字以上、40文字以下で入力してください',
            'password.required' => 'パスワードが一致しません',
            'password.min' => 'パスワードは8文字以上、20文字以下で入力してください',
            'password.max' =>'パスワードは8文字以上、20文字以下で入力してください',
            'password.confirmed' =>'確認パスワードが一致していません',
            'password.alpha_num' =>'パスワードは英数字で入力してください',
            'images.images'=>'指定されたファイルは画像ではありません',
            'images.alpha_num'=>'ファイル名は英数字のみです',
            'images.mimes'=>'指定されたファイルは画像ではありません',

        ];

         }
        $validate = Validator::make($request->all(), $rulus, $message, );//バリデーションを実行

        if ($validate->fails()) {
          return redirect('/profile')
          // エラーを返すか、エラーとともにリダイレクトする
          -> withInput() // セッション()に入力値すべてを入れる
          ->withErrors($validate); // セッション(errors)にエラーの情報を入れる　

      }else{
        //inputで最終的に保存したい記述
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
         'password' =>  bcrypt($password), // bcryptでハッシュ化(暗号化)
         'bio' => $bio,
         'images' => $images,
   ]);
      }

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

    // $users = Auth::user();今ログインしている人のユーザーを取得　
// $request入力された値を$keywordに格納→$keywordで何かしらの値を受け取った場合は、if文の中で取得するデータを絞りこむ
// =>添字にあたる'users'部分（キー）を文字列で指定
//compact関数とはコントローラで受け取った値をビューへ受け渡す



 //

}

