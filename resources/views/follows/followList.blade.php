@extends('layouts.login')

@section('content')

<div id="/follows.followerList">
                <!-- 一覧表示 -->
                <form action=/follow-list method="get">
                @foreach($followings as $isFollowing)
                <td><img src="{{ asset('storage/images/' . $isFollowing->images) }}"></td>
                @csrf

                @endforeach

                </form>
@endsection