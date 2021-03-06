@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-6 hidden">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Welcome</h3>
          </div>
          <div class="panel-body">
            Welcome!
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">最新文章</h3>
          </div>
          <!-- <div class="panel-body"> -->
          <!-- </div> -->
          <ul class="list-group">
            @forelse ($articles as $article)
            <li class="list-group-item">
              <h4><small>{!! $article->creator->link() !!} {{ $article->info() }}</small></h4>
              <h4><a href="/article/{{ $article->id }}">{{ $article->title }}</a></h4>
              <p>{!! $article->gfm(512) !!}...</p>
            </li>
            @empty
            <li class="list-group-item">没有文章</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    @include('attention')
  </div>
</div>
@endsection
