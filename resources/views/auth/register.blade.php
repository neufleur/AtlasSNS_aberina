@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください bladeにメッセージ-->
<div class="register">
    <h2 class="atlas-yoko">新規ユーザー登録</h2>
    {!! Form::open(['url' => '/register']) !!}
    <!-- バリデーションメッセージ -->
    @csrf
    @if($errors->any())
         <div class="alert alert-danger">
           <ul>
               @foreach($errors->all() as $error)
             <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
    <div class="login-user">
        {{ Form::label('user name') }}
        {{ Form::text('username',null,['class' => 'login-input']) }}

        {{ Form::label('mail adress') }}
        {{ Form::text('mail',null,['class' => 'login-input']) }}

        {{ Form::label('password') }}
        {{ Form::password('password',null,['class' => 'login-input']) }}

        {{ Form::label('password comfirm') }}
        {{ Form::password('password',null,['class' => 'login-input']) }}
    </div>

    {{ Form::submit('REGISTER',['class' => 'register-btn']) }}

    <a href="/login"><p class="back">ログイン画面へ戻る</p></a>

    {!! Form::close() !!}
</div>

@endsection


