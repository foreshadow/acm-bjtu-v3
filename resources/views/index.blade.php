@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">Welcome</div>
        <div class="panel-body">
          Welcome!
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          最新文章
        </div>
        <!-- <div class="panel-body"> -->
        <!-- </div> -->
        <ul class="list-group">
          @forelse ($articles as $article)
          <li class="list-group-item">
            <p class="pull-right"><small>{!! $article->creator->link() !!} {{ $article->info() }}</small></p>
            <p><a href="/article/{{ $article->id }}">{{ $article->title }}</a></p>
          </li>
          @empty
          <li class="list-group-item">没有文章</li>
          @endforelse
        </ul>
      </div>
    </div>
    <div class="col-md-3">
      @include('attention')
    </div>
  </div>
</div>
@endsection
