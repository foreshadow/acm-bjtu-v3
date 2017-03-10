@extends('layouts.app')

@section('content')
<div class="col-md-8">
  <h3>修改现场赛</h3>
  <form action="/onsite/{{ $contest->id }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
      <label for="title">标题</label>
      <input id="title" class="form-control input-sm" type="text" name="title" value="{{ $contest->title }}" required>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="begin_at">开始时间</label>
        <input id="begin_at" class="form-control input-sm" type="datetime-local" value="{{ htmldatetime($contest->begin_at) }}" name="begin_at" required>
      </div>
      <div class="form-group col-md-6">
        <label for="end_at">结束时间</label>
        <input id="end_at" class="form-control input-sm" type="datetime-local" name="end_at" value="{{ htmldatetime($contest->end_at) }}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="begin_register_at">开始报名</label>
        <input id="begin_register_at" class="form-control input-sm" type="datetime-local" name="begin_register_at" value="{{ htmldatetime($contest->begin_register_at) }}" required>
      </div>
      <div class="form-group col-md-6">
        <label for="end_register_at">结束报名</label>
        <input id="end_register_at" class="form-control input-sm" type="datetime-local" name="end_register_at" value="{{ htmldatetime($contest->end_register_at) }}" required>
      </div>
    </div>
    <div class="form-group">
      <label for="location">地点</label>
      <input id="location" class="form-control input-sm" type="text" name="location" value="{{ $contest->location }}" required>
    </div>
    <div class="form-group">
      <label for="body">介绍</label>
      <textarea id="body" class="form-control input-sm" type="text" name="body" rows="10">{{$contest->body }}</textarea>
    </div>
    <div class="row">
      <div class="form-group col-md-3">
        @icon('file')
        {{ Form::label('renderer', '内容格式') }}
        {{ Form::select('renderer', array('markdown' => 'Markdown', 'html' => 'HTML', 'plaintext' => 'Plain text'), $contest->renderer,
           ['class' => 'form-control input-sm', 'id' => 'renderer']) }}
        <span class="help-block"><small>尝试一下markdown吧！</small></span>
      </div>
      <div class="col-md-9">
        <br>
        <button type="submit" class="btn btn-sm btn-primary pull-right">@icon('send')发布</button>
      </div>
    </div>
  </form>
</div>
@endsection
