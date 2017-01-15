@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">修改资料</div>
        <div class="panel-body">
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            <strong>修改失败</strong> 输入不符合要求<br><br>
            {!! implode('<br>', $errors->all()) !!}
          </div>
          @endif
          {{ Form::open(['url' => 'user/' . Auth::id(), 'method' => 'post',  'enctype' => 'multipart/form-data', 'class' => 'form-horizontal']) }}
            {{ method_field('PUT') }}
            <div class="form-group form-group-sm">
              {{ Form::label('', '邮箱', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                <p class="form-control-static">{{ Auth::user()->email }}</p>
              </div>
              <span class="help-block"></span>
            </div>
            <!-- <div class="form-group form-group-sm">
              {{ Form::label('', '原密码', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::password('password', ['class' => 'form-control input-sm']) }}
              </div>
            </div> -->
            <div class="form-group form-group-sm">
              {{ Form::label('', '头像', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::file('avatar') }}
              </div>
            </div>
            <div class="form-group form-group-sm">
              {{ Form::label('', '昵称', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::text('name', Auth::user()->name, ['class' => 'input-sm form-control']) }}
              </div>
              <span class="help-block">网站中显示的名称</span>
            </div>
            <div class="form-group form-group-sm">
              {{ Form::label('', '真实姓名', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::text('realname', Auth::user()->realname, ['class' => 'input-sm form-control']) }}
              </div>
              <span class="help-block">你的名字</span>
            </div>
            <div class="form-group form-group-sm">
              {{ Form::label('', '学院', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::text('location1', Auth::user()->location1, ['class' => 'input-sm form-control']) }}
              </div>
              <span class="help-block"></span>
            </div>
            <div class="form-group form-group-sm">
              {{ Form::label('', '班级', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::text('location2', Auth::user()->location2, ['class' => 'input-sm form-control']) }}
              </div>
              <span class="help-block"></span>
            </div>
            <div class="form-group form-group-sm">
              {{ Form::label('', 'Codeforces handle', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::text('handle', Auth::user()->handle, ['class' => 'input-sm form-control']) }}
              </div>
              <span class="help-block">显示Codeforces状态！</span>
            </div>
            <div class="form-group form-group-sm">
              {{ Form::label('', '手机', ['class' => 'col-md-3 control-label']) }}
              <div class="col-md-3">
                {{ Form::text('phone', Auth::user()->phone, ['class' => 'input-sm form-control']) }}
              </div>
              <span class="help-block">用来发送短信通知</span>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-3">
                <button type="submit" class="btn btn-sm btn-primary">@icon('send')提交</button>
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
