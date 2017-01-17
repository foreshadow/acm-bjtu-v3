@extends('layouts.app')

<!-- Main Content -->
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

          <form class="form-horizontal" role="form" method="POST" action="/password/email">
            {{ csrf_field() }}

            <div class="form-group form-group-sm{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-2 control-label">邮箱</label>

              <div class="col-md-4">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span> @endif
              </div>
            </div>

            <div class="form-group form-group-sm">
              <div class="col-md-4 col-md-offset-2">
                <button type="submit" class="btn btn-sm btn-primary">@icon('send')发送重置链接</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection