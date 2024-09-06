@extends('layouts.login')

@section('content')

<div id="profile">
{{ Form::open(['url' => '/profile/update','enctype'=>'multipart/form-data']) }} <!-- Formタグにファイル形式のものを送るときの宣言 enctype　= 'multipart/form-data'-->
        @csrf
        {{ Form::hidden('id', $auth->id) }}
        <!-- イメージ画像はif文で初期画像と更新後の画像を切り替えられるようにする -->
          <p><img src="{{ asset('storage/images/' . $auth->images) }}" ></p>
          @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif
        <!-- app/public/imagesはログインしているユーザーが変えられない管理者のみが変更可　　storage/images/はログインしているユーザーが変えられるなのでicon1のみ画像保存 -->
        <label>username<input type="text" name="username" placeholder="" value="{{ $auth->username }}"></label>
        <label>mail adress<input type="mail" name="mail" placeholder="" value="{{ $auth->mail }}"></label>
        <label>password<input type="password" name="password" placeholder="" value=""></label>
        <label>password comfirm <input type="password" name="password" placeholder="" value=""></label>
        <label>bio<input type="bio" name="bio" placeholder="" value="{{ $auth->bio }}"></label>
        <label>icon image<input type="file" name="images"></label>
        <label><button id="sbtn" type="submit" class="btn btn-primary" value="更新"></label></button>
        {{ Form::close() }}
    </form>
</div>
@endsection

<!-- 更新　画像更新　バリデーション -->
