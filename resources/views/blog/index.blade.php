@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          最新文章
        </div>
        <!-- <div class="panel-body"> -->
        <!-- </div> -->
        <ul class="list-group">
          @forelse ($articles as $article)
          <li class="list-group-item">
            <h4>
              <p class="pull-right"><small>{!! $article->creator->link() !!} {{ $article->info() }}</small></p>
              <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
            </h4>
            <div>
              {!! $article->text() !!}
            </div>
          </li>
          @empty
          <li class="list-group-item">没有文章</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
