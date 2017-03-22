@extends('layouts.md')

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
            <h4>
              <small class="pull-right">—— {!! $problem->author->link() !!}</small>
              <a href="/problem/{{ $problem->id }}">{{ $problem->title }}</a>
            </h4>
            <p class="pull-right">修改于{{ $problem->updated_at }}</p>
            <p class="text-inline" style="padding-right: 30px;">{{ mb_substr($problem->description, 0, 100) }}</p>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
