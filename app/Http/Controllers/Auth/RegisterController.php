<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $rulus = [
                //バリデーションの追加
                'username' => 'required|min:2|max:12',
                'mail' => 'required|email|min:5|max:40|unique:users,mail',
                'password' => 'required|alpha_num|min:8|max:20|confirmed|string',
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
                'password.required' => 'パスワードは入力必須です',
                'password.min' => 'パスワードは8文字以上、20文字以下で入力してください',
                'password.max' =>'パスワードは8文字以上、20文字以下で入力してください',
                'password.confirmed' =>'確認パスワードが一致していません',
                'password.alpha_num' =>'パスワードは英数字で入力してください',
            ];
            $validate = Validator::make($request->all(), $rulus, $message, );//バリデーションを実行

        if ($validate->fails()) {
          return redirect('/profile')
          // エラーを返すか、エラーとともにリダイレクトする
          -> withInput() // セッション()に入力値すべてを入れる
          ->withErrors($validate); // セッション(errors)にエラーの情報を入れる　

           }else{
            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');


            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);
            $request->session()->put('username', $username); //セッションへデータを保存　追記
        }
        return redirect('added');
        }

            return view('auth.register');

              }


            public function added(){
                return view('auth.added');
                   }
    }



