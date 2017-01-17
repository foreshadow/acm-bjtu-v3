@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">重置密码</div>

        <div class="panel-body">
          @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
          @endif

          <form class="form-horizontal" role="form" method="POST" action="/password/reset">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group form-group-sm{{ $errors->has('email') ? ' has-error' : '' }}">
              <label class="col-md-2 control-label">邮箱</label>
              <div class="col-md-4">
                <p class="form-control-static">{{ $email }}</p>
              </div>
            </div>

            <div class="form-group form-group-sm{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-2 control-label">密码</label>
              <div class="col-md-4">
                <input id="password" type="password" class="form-control" name="password" required autofocus>
                @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
                </span> @endif
              </div>
            </div>

            <div class="form-group form-group-sm{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
              <label for="password-confirm" class="col-md-2 control-label">确认密码</label>
              <div class="col-md-4">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required> @if ($errors->has('password_confirmation'))
                <span class="help-block">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span> @endif
              </div>
            </div>

            <div class="form-group form-group-sm">
              <div class="col-md-4 col-md-offset-2">
                <button type="submit" class="btn btn-sm btn-primary">@icon('send')重置</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
