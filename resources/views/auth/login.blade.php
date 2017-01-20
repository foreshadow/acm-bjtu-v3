@extends('layouts.nonavbar')

@section('content')
<br>
<br>
<br>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h2 class="text-center">登录 {{ config('app.name') }}</h2>
      <br>
      <div class="panel panel-default">
        <div class="panel-body">
          <form class="form" role="form" method="POST" action="/login">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="control-label">邮箱</label>
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <a class="btn btn-sm btn-link pull-right" href="/password/reset">忘记密码</a>
              <label for="password" class="control-label">密码</label>
              <input id="password" type="password" class="form-control" name="password" required>
              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group">
              <div class="checkbox hidden">
                <label>
                  <!-- <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>记住我 -->
                  <input type="checkbox" name="remember" checked>记住我
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-block btn-primary">@icon('send')登录</button>
          </form>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-body text-center">
          没有账号？<a href="/register">注册</a>
        </div>
      </div>
      <hr>
      <div class="text-center">
        <a href="/" class="text-muted">首页</a>
      </div>
    </div>
  </div>
</div>
@endsection
