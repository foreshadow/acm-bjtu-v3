@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          @role('admin')
          @foreach ($user->roles as $role)
            <div class="label label-info">
              {{ $role->name }}
              @if (Auth::user()->level() > $user->level())
                <form action="/user/{{ $user->id }}/role" method="post" style="display: inline;">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <input type="text" name="role" value="{{ $role->slug }}" class="hidden">
                  <button class="close" style="float: inherit; font-size: inherit;">&times;</button>
                </form>
              @endif
            </div>        &nbsp;
            {{-- bug here ^ --}}
          @endforeach
          @if (Auth::user()->assignableRoles($user->id))
            <form action="/user/{{ $user->id }}/role" method="post" class="form-inline" style="display: inline;">
              {{ csrf_field() }}
              {{ Form::select('role', Auth::user()->assignableRoles($user->id), '', ['class' => 'input-xs form-control']) }}
              <button type="submit" class="btn btn-xs btn-success">@icon('plus')添加角色</button>
            </form>
          @endif
          @endrole
          <div class="avatar avatar-xl pull-right">
            @if ($user->url())
              <img src="{{ $user->url() }}">
            @endif
          </div>
          <div>
            @if (Auth::id() == $user->id)
              <a href="/user/{{ $user->id }}/edit" class="btn btn-sm btn-primary pull-right">@icon('pencil')修改</a>
            @endif
            <h3>{{ $user->name }}
              <small>{{ $user->email }}</small>
            </h3>
            <p>{{ $user->realname }}，来自 {{ $user->location1 }} {{ $user->location2 }}</p>
            @if ($user->handle)
              @if ($user->codeforces_user)
                <p>
                  <strong>Codeforces handle</strong>
                  <span class="{{ $user->codeforces_user->codeforces_rank_color_class() }}">
                  <!-- <img src="{{ $user->codeforces_user->avatar }}" style="max-width: 46px; max-height: 46px; border-radius: 3px; float: left;"> -->
                    <span class="rated-user" style="font-size: 2rem;">{{ $user->codeforces_user->handle }}</span>
                  <span style="font-family: verdana; font-weight: bold;">
                    ({{ ucwords($user->codeforces_user->rank) }}
                    {{ $user->codeforces_user->rating }})
                  </span>
                </span>
                </p>
              @else
                <p>
                  <strong>Codeforces handle</strong>
                  {{ $user->handle }}
                </p>
              @endif
            @endif
            <hr>
            <p>
              最后登录于
              @if ($user->online())
                <strong><span class="text-success">当前在线</span></strong>
              @else
                {{ relative_time($user->updated_at->timestamp - time()) }}
              @endif
              <br>
              注册于 {{ relative_time($user->created_at->timestamp - time()) }}
            </p>
          </div>
        </div>
        <ul class="list-group">
          @foreach ($articles as $article)
            <li class="list-group-item">
              <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
              <p class="pull-right">
                <small>{{ $article->info() }}</small>
              </p>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
