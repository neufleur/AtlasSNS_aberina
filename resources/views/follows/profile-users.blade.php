@extends('layouts.login')

@section('content')

<form action='/profile-users' method="get">
@csrf

<div class="other-profile">
<img src="{{ asset('storage/images/' . $profile->images) }}">
<br>{{ $profile->username }}</br>
<br>{{ $profile->bio }}</br>
</div>


<div class="other-post">
@foreach ($profile as $post)
<img src="{{ asset('storage/images/' . $profile->images) }}">
<br>{{ $profile->username }}</br>
<br>{{ $profile->post }}</br>
@endforeach
</div>
</form>
@endsection