@extends('layouts.login')

@section('content')

<form action='/profile-users' method="get">
@csrf

</form>
@endsection