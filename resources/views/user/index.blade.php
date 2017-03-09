@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <ul class="list-group">
          @foreach ($users as $user)
          <li class="list-group-item">
            @if ($user->online())
            <p class="pull-right"><strong><span class="text-success">在线</span></strong></p>
            @else
            <p class="pull-right"><span class="text-muted">上次在线 {{ relative_time(strtotime($user->active_at) - time()) }}</span></p>
            @endif
            <a href="/user/{{ $user->id }}">{{ $user->name }}</a>
            @role('admin | superadmin')
            @foreach ($user->roles as $role)
            <span class="label label-info">{{ $role->name }}</span>
            @endforeach
            @endrole
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
