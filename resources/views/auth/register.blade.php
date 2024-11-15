@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}
<div class="register">
<h2 class="atlas-yoko">新規ユーザー登録</h2>
<div class="login-user">
{{ Form::label('user name') }}
{{ Form::text('username',null,['class' => 'login-input']) }}

{{ Form::label('mail adress') }}
{{ Form::text('mail',null,['class' => 'login-input']) }}

{{ Form::label('password') }}
{{ Form::text('password',null,['class' => 'login-input']) }}

{{ Form::label('password comfirm') }}
{{ Form::text('password_confirmation',null,['class' => 'login-input']) }}
</div>

{{ Form::submit('REGISTER',['class' => 'register-btn']) }}

<a href="/login"><p class="back">ログイン画面へ戻る</p></a>

{!! Form::close() !!}
</div>

@endsection


