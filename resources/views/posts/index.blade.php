@extends('layouts.login')

@section('content')

{{ Form::open(['url' => '/posts']) }}

 <!-- <form action='/posts' method="post">  @csrfはフォームの外側に入力-->
<div id="post">
<p class="icon"><img src="{{ asset('storage/images/' . Auth::user()->images) }}"></p>
<label><textarea name="post.text" name="text" placeholder="投稿内容を入力してください" value="" cols="90" rows="6"></textarea></label>
<button id="sbtn" type="submit"><img src="{{ asset('images/post.png') }}" >
{{ Form::close() }}
</div>
@endsection