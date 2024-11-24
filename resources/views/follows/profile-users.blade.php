@extends('layouts.login')

@section('content')

<form action='/profile-users' method="get"></form>
@csrf

<div class="other-profile">
<p class="p-img"><img src="{{ asset('storage/images/' . $profile->images) }}" width="90px" height="90px"></p>
<ul>
<div class="n-b"><li class="other-name">name</li><li class="p-name-bio">{{ $profile->username }}</li></div>
<div class="n-b"><li class="other-bio">bio</li><li class="p-name-bio">{{ $profile->bio }}</li></div>
</ul>

         <!-- フォローするフォロー解除ボタン機能 user.phpからの取得-->
         @if(auth()->user()->isFollowing($profile->id))

<!--ログインしているユーザー　フォローするデータ送る  -->
<!-- ['user' => $user->id]) 'user'はコントローラーのpublic function Follow(User $user) 同じ関数-->
<form action="{{ route('unFollow', ['user' => $profile->id]) }}" class="btn" method="post">
@csrf
  <!-- フォロー解除-->
  <td><button type="submit" class="f-btn btn-danger">フォロー解除</button></td></form>
@else
<form action="{{ route('Follow', ['user' => $profile->id]) }}" class="btn"  method="post">
  <!-- フォローする-->
@csrf
<td><button type="submit" class="f-btn btn-primary">フォローする</button></td></form>
@endif
</div>


@foreach ($post as $post)
<div class="ff-post">
<img class="ff-img" src="{{ asset('storage/images/' . $post->user->images) }}" width="90px" height="90px">
<div class="f-post-name"><br>{{ $post->user->username }}</br>
<br>{{ $post->post }}</br></div>
<div class="f-at"><span>{{$post->created_at->format('Y-m-d H:i')}}</span></div>
</div>
@endforeach
</form>
@endsection