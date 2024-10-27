@extends('layouts.login')

@section('content')

<form action='/profile-users' method="get">
@csrf

<div class="other-profile">
<img src="{{ asset('storage/images/' . $profile->images) }}">
<br>{{ $profile->username }}</br>
<br>{{ $profile->bio }}</br>





<div class="other-post">
@foreach ($post as $post)
<img src="{{ asset('storage/images/' . $post->user->images) }}">
<br>{{ $post->user->username }}</br>
<br>{{$post->created_at}}</br>
<br>{{ $post->post }}</br>
@endforeach
</div>
</form>
@endsection