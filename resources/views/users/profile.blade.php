@extends('layouts.login')

@section('content')

<div id="profile">
  <div class="container">
{{ Form::open(['url' => '/profile/update','enctype'=>'multipart/form-data']) }} <!-- Formタグにファイル形式のものを送るときの宣言 enctype　= 'multipart/form-data'-->
        @csrf
        {{ Form::hidden('id', $auth->id) }}
        <!-- イメージ画像はif文で初期画像と更新後の画像を切り替えられるようにする -->
          @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif
<div class="profile-update">
        <img src="{{ asset('storage/images/' . $auth->images) }}" >
        <!-- app/public/imagesはログインしているユーザーが変えられない管理者のみが変更可　　storage/images/はログインしているユーザーが変えられるなのでicon1のみ画像保存 -->
        <div>
        <label class="profile-add">username<input type="text" class="form-name" name="username" placeholder="" value="{{ $auth->username }}"></label>
        <label class="profile-add">mail adress <input type="mail" class="form-mail" name="mail" placeholder="" value="{{ $auth->mail }}"></label>
        <label class="profile-add">password<input type="password" class="form-password" name="password" placeholder="" value=""></label>
        <label class="profile-add">password comfirm<input type="password" class="form-password" name="password_confirmation" placeholder="" value=""></label>
        <label class="profile-add">bio<input type="bio" class="form-bio" name="bio"  placeholder="" value="{{ $auth->bio }}"></label>
        <label class="profile-add">icon image<input type="file" class="f-images" name="images"></label>
        <button id="sbtn" class="up-btn" type="submit" class="btn btn-primary" value="更新">更新</button>
        {{ Form::close() }}
        </div>
        </div>
</div>
</div>
@endsection

<!-- 更新　画像更新　バリデーション -->
