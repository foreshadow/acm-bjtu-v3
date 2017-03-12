@extends('layouts.app')

@section('content')
<div class="row">
  @role('superadmin')
    <div class="col-md-8">
  @else
    <div class="col-md-8 col-md-offset-2">
  @endrole
    <div class="panel panel-default">
      <ul class="list-group">
        @foreach ($users as $user)
          <li class="list-group-item">
            <div class="pull-right">
              @if ($user->online())
                <strong><span class="text-success">在线</span></strong>
              @else
                <span class="text-muted">上次在线 {{ relative_time(strtotime($user->active_at) - time()) }}</span>
              @endif
            </div>
            <a href="/user/{{ $user->id }}">{{ $user->name }}</a>
            @role('admin')
              @foreach ($user->roles as $role)
                <span class="label label-info">{{ $role->name }}</span>
              @endforeach
            @endrole
          </li>
        @endforeach
      </ul>
    </div>
  </div>
  @role('admin')
    <div class="col-md-4">
      <div class="panel panel-default">
        <ul class="list-group">
          @foreach ($users as $user)
            <li class="list-group-item">
              <form action="/user/{{ $user->id }}/role" method="post" class="form-inline" style="display: inline;">
                @if (Auth::user()->assignableRoles($user->id))
                  {{ csrf_field() }}
                  {{ Form::select('role', Auth::user()->assignableRoles($user->id), '', ['class' => 'input-xs form-control']) }}
                  <button type="submit" class="btn btn-xs btn-success">@icon('plus')添加角色</button>
                @else
                  {{ Form::select('role', Auth::user()->assignableRoles(), '', ['class' => 'input-xs form-control']) }}
                  <button type="button" class="btn btn-xs btn-warning disabled">@icon('remove')不可操作</button>
                @endif
              </form>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  @endrole
</div>
@endsection
