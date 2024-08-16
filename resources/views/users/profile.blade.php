@extends('layouts.login')

@section('content')

<div id="profile">
    <form action='/profile' method="get">
        @csrf
        <p><img src="{{ asset('$auth->images') }}" ></p>
        <label>username<input type="text" name="username" placeholder="" value="{{ $auth->username }}"></label>
        <label>mail adress<input type="mail" name="mail" placeholder="" value="{{ $auth->mail }}"></label>
        <label>password<input type="password" name="password" placeholder="" value=""></label>
        <label>password comfirm <input type="password" name="password" placeholder="" value=""></label>
        <label>bio<input type="bio" name="bio" placeholder="" value="{{ $auth->bio }}"></label>
        <label>icon image<input type="file" name="images" class="custom-file-input" id="fileImage"></label>
        <label><button id="sbtn" type="submit" class="btn btn-primary" value="更新"></label>
        </button>
    </form>
</div>
@endsection