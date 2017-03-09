@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">注册</h3>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="/register">
          {{ csrf_field() }}
          <div class="form-group form-group-sm{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-2 control-label">昵称</label>
            <div class="col-md-4">
              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
            <span class="help-block">起个响亮的名字吧！</span>
          </div>
          <div class="form-group form-group-sm{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-2 control-label">邮箱</label>
            <div class="col-md-4">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
            <span class="help-block">校内用户请使用bjtu.edu.cn邮箱</span>
          </div>
          <div class="form-group form-group-sm{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-2 control-label">密码</label>
            <div class="col-md-4">
              <input id="password" type="password" class="form-control" name="password" required>
              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group form-group-sm">
            <label for="password-confirm" class="col-md-2 control-label">确认密码</label>
            <div class="col-md-4">
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
          </div>
          <div class="form-group form-group-sm">
            <div class="col-md-4 col-md-offset-2">
              <button type="submit" class="btn btn-sm btn-primary">@icon('send')注册</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
