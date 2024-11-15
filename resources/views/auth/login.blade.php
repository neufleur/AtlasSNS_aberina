@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login']) !!}
<div class="login">
<p class="atlas-yoko">AtlasSNSへようこそ</p>
<div class="login-user">
{{ Form::label('mail adress') }}
{{ Form::text('mail',null,['class' => 'login-input']) }}
{{ Form::label('password') }}
{{ Form::password('password',['class' => 'login-input']) }}
</div>

{{ Form::submit('LOGIN',['class' => 'login-btn']) }}

<a href="/register"><p class="new-user">新規ユーザーの方はこちら</p></a>

{!! Form::close() !!}
</div>
@endsection
