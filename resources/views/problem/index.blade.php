@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">题目列表</h3>
      </div>
      <div class="panel-body">
        <a href="/problem/create" class="btn btn-sm btn-success">@icon('plus')新建</a>
      </div>
      <ul class="list-group">
        @foreach ($problems as $problem)
          <li class="list-group-item">
            <a href="/problem/{{ $problem->id }}">{{ $problem->title }}</a>
            <small>{{ $problem->author->name }}</small>
            ——
            <small>{{ mb_substr($problem->description, 0, 30) }}</small>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
