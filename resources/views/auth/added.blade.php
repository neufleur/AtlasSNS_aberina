@extends('layouts.logout')

@section('content')


<div class="added-login">
  <p class="name-yoko">{{ session('username') }}さん</p>
  <p class="name-yoko">ようこそ！AtlasSNSへ</p>
  <div class="added">
  <p class="added-yoko">ユーザー登録が完了しました。
  <p class="added-yoko">早速ログインをしてみましょう。</p>
  </div>
  <a href="/login"><p class="added-btn">ログイン画面へ</p></a>
</div>

@endsection