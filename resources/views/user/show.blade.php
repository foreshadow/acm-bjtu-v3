@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <!-- <div class="panel-heading"></div> -->
        <div class="panel-body">
          <div class="pull-right" style="width: 150px; height: 150px; margin-left: 15px;">
            <img src="{{ $user->url() }}" style="max-width: 150px; max-height: 150px; border-radius: 3px;">
          </div>
          <div>
            @if (Auth::id() == $user->id)
            <a href="/user/{{ $user->id }}/edit" class="btn btn-sm btn-primary pull-right">@icon('pencil')修改</a>
            @endif
            <h3>{{ $user->name }}</h3>
            <p><small>{{ $user->email }}</small></p>
            <p>{{ $user->realname }}</p>
            <p>{{ $user->location1 }} {{ $user->location2 }}</p>
            <p><span class="label label-primary">Codeforces handle</span> {{ $user->handle }}</p>
            <hr>
            <p>最后登录于 {{ App\Functions::relative_time($user->updated_at->timestamp - time(), true) }}</p>
            <p>注册于 {{ App\Functions::relative_time($user->created_at->timestamp - time(), true) }}</p>
          </div>
        </div>
        <ul class="list-group">
          @foreach ($articles as $article)
          <li class="list-group-item">
            <a href="{{ $article->id }}">{{ $article->title }}</a>
            <p class="pull-right"><small>{{ $article->info() }}</small></p>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
