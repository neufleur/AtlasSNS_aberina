@extends('layouts.login')

@section('content')

<form action='/profile-users' method="get">
@csrf

<div class="other-profile">
<p class="p-img"><img src="{{ asset('storage/images/' . $profile->images) }}" width="90px" height="90px"></p>
<ul>
<div class="n-b"><li class="other-name-bio">name</li><li class="p-name-bio">{{ $profile->username }}</li></div>
<div class="n-b"><li class="other-name-bio">bio</li><li class="p-name-bio">{{ $profile->bio }}</li></div>
</ul>

         <!-- フォローするフォロー解除ボタン機能 user.phpからの取得-->
         @if(auth()->user()->isFollowing($profile->id))

<!--ログインしているユーザー　フォローするデータ送る  -->
<!-- ['user' => $user->id]) 'user'はコントローラーのpublic function Follow(User $user) 同じ関数-->
<form action="{{ route('unFollow', ['user' => $profile->id]) }}" method="post">
@csrf
  <!-- フォロー解除-->
  <td><style></style><button type="submit" class="btn btn-danger">フォロー解除</button></td></style>
</form>
@else
<form action="{{ route('Follow', ['user' => $profile->id]) }}"  method="post">
  <!-- フォローする-->
@csrf
<td><button type="submit" class="btn btn-primary">フォローする</button></td>
@endif
</style>
</form>
</div>

@foreach ($post as $post)
<div class="ff-post">
<img class="ff-img" src="{{ asset('storage/images/' . $post->user->images) }}" width="90px" height="90px">
<div class="f-post-name"><br>{{ $post->user->username }}</br>
<br>{{ $post->post }}</br></div>
<div class="f-at"><span>{{$post->created_at}}</span></div>
</div>
@endforeach
</form>
@endsection