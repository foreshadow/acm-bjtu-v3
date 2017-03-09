@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Pastebin</h3>
      </div>
      <div class="panel-body">
        <form action="/pastebin" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label>标题</label>
            <input class="form-control" type="text" name="title">
          </div>
          <div class="form-group">
            <label>内容</label>
            <textarea class="form-control" name="body" rows="15"></textarea>
          </div>
          <button class="btn btn-sm btn-primary" type="submit">@icon('send')提交</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
