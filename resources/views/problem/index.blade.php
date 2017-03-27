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
              <br>
              <small class="pull-right">修改于{{ partial_relative($problem->updated_at) }}</small>
              <small>时间限制 {{ $problem->time }} ms，内存限制 {{ $problem->memory }} MB</small>
            </h4>
            <div class="pull-right">
              @if ($problem->generator == null)
                <small><span class="label label-warning">@icon('exclamation-sign')No generator</span> </small>
              @endif
              @if ($problem->solution == null)
                <small><span class="label label-danger">@icon('exclamation-sign')No solution</span></small>
              @endif
            </div>
            <p class="text-inline" style="padding-right: 30px;">{{ mb_substr($problem->description, 0, 256) }}</p>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection
