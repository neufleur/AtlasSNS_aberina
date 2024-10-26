@extends('layouts.login')

@section('content')

<form action='/profile-users' method="get">
@csrf


<img src="{{ asset('storage/images/' . $profile->images) }}">
<br>{{ $profile->username }}</br>



</form>
@endsection