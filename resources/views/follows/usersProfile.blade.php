@extends('layouts.login')

@section('content')

<form action='/profile-users' method="get">
@csrf
<!-- <img src="{{ asset('storage/images/' . $images->images) }}"></a> -->
</form>
@endsection