@extends('layouts.login')

@section('content')
@csrf
{{ Form::open(['url' => '/posts']) }}
 <!--新規投稿 <form action='/posts' method="post">  @csrfはフォームの外側に入力-->
<div id="post-all">
  <div class="post">
@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif
  <!-- バリデーションチェックに引っかかった場合、ビューファイルにエラーメッセージを表示させる必要がある @if($errors->any())から@endifまで
具体的には、エラーメッセージが1つ以上存在するかどうかを確認し、エラーメッセージが存在する場合は、全てのエラーメッセージをforeachを使って表示させています。-->
<div >
<p class="icon"><img class="post-images" src="{{ asset('storage/images/' . Auth::user()->images) }}" width="70px" height="70px">
<textarea name="post" style="white-space: pre-wrap;" placeholder="投稿内容を入力してください。" value="post-edit" cols="10" rows="3"></textarea>

<button class="post-png"><img class="post-png" src="{{ asset('images/post.png') }}" ></button></p>
</div>
</div>
{{ Form::close() }}

<table class="post-table table-hover">
                <!-- 一覧表示 -->
                <form action=/post/update method="post">
                @csrf
                @foreach($post as $post)
                <div class="ff-post">
                <div class="p-img"><img src="{{ asset('storage/images/' . $post->user->images) }}"  width="70px" height="70px"></div>
                <div class="f-post-name"><br>{{$post->user->username}}</br></div>
                <div class="f-post-name" style="white-space: pre-wrap;"><br>{{$post->post}}</br></div>
               <div class="f-at"><span>{{ $post->created_at->format('Y-m-d H:i')}}</span>
              
                <!-- authorがBook.php（モデル）に定義したメソッドで、nameがテーブルのカラム名を表しています。 -->
                <div class="edit-trash">
                 @if(Auth::user()->id ==$post->user_id)
                <!-- モーダルの中身 open -->
           <div class=""><a class="js-modal-open" class="btn btn-primary" post="{{ $post->post }}" post_id="{{ $post->id }}" href="/post/{{$post->id}}/update-Form"><img class="edit-png" src="{{ asset('images/edit.png') }}" ></a></div>
               <div class="trash-png"> <a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除します。よろしいでしょうか？')" ><img class="trash"></a></div>
                @endif
                </div>
                </div>
                </div>
           <!-- 更新ボタンの作成 クラス名「btn-primary」を追加 HTTPの通信方法をGETにして、URLにパラメータを一緒に送れるように -->
                <!-- ↓　ここを追加してください こちらもパラメータ付きのGET送信になるので、移動先のURL指定に各リストのID番号を設置しております。 -->

                @endforeach
               
                </form>
            <!-- モーダルの中身 close aタグはリンクに飛ぶタグを指定　-->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">

           <form action="/post/update" method="get">
           @csrf
            @if($errors->any())
         <div class="alert alert-danger">
           <ul>
               @foreach($errors->all() as $error)
             <li>{{ $error }}</li>
               @endforeach
            </ul>
        </div>
              @endif
                <textarea name="post-modal" class="modal_post" cols="10" rows="8"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <button class="edit-png-2"><img src="{{ asset('images/edit.png') }}" width="60px" height="60px"></button>
                 <!--編集したものを送信されて保存するため使う　formタグの中に入れて反映させる　-->
                {{ csrf_field() }}
           </form>
        </div>
    </div>



</table>
</div>
@endsection
