@extends('layouts.md')

@section('title', $article->title)

@section('content')
<div class="row">
  @if ($article->toc)
  <div class="col-md-9">
  @else
  <div class="col-md-8 col-md-offset-2">
  @endif
    <div id="content">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3>{{ $article->title }}</h3>
          @if (Auth::check() && Auth::id() == $article->user_id)
          <a href="/article/{{ $article->id }}/edit" class="btn btn-sm btn-primary pull-right">@icon('pencil')编辑</a>
          @endif
          <p>{!! $article->creator->link() !!} <small>{{ $article->info() }}</small></p>
        </div>
        <div class="panel-body">
          @if ($article->renderer == 'markdown')
          <?php $toc = new App\TOC($article->gfm(), $article->label); echo $toc->html(); ?>
          @else
          <?php $toc = new App\TOC($article->body, $article->label); echo $toc->html(); ?>
          @endif
        </div>
      </div>
      @foreach ($comments as $comment)
      <div>
        <div class="avatar avatar-md">
          <img src="{{ $comment->author->url() }}">
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            @if ($comment->author->id == Auth::id())
            <form action="/comment/{{ $comment->id }}" method="POST">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="close" data-confirm="你确定吗？"
                      data-toggle="tooltip" data-placement="left" title="<span class='glyphicon glyphicon-trash'></span> 删除">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
              </button>
            </form>
            @endif
            {!! $comment->author->link() !!}
            <small class="text-muted">{{ $comment->info() }}</small>
          </div>
          <div class="panel-body">
            <div class="markdown">
              {!! $comment->gfm() !!}
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @if (Auth::check())
      <div>
        <div class="avatar avatar-md">
          <img src="{{ Auth::user()->url() }}">
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">评论</h3>
          </div>
          <div class="panel-body">
            <form action="/comment" method="post">
              {{ csrf_field() }}
              <input name="article_id" value="{{ $article->id }}" class="hidden">
              <div class="form-group">
                <div>
                  <textarea name="body" rows="3" class="form-control" required></textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-sm btn-success pull-right">@icon('pencil')评论</button>
            </form>
          </div>
        </div>
      </div>
      @else
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">评论</h3>
        </div>
        <div class="panel-body">
          请先<a href="/login">登录</a>
        </div>
      </div>
      @endif
    </div>
  </div>
  @if ($article->toc)
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>目录</h4>
      </div>
      <div class="panel-body">
        <?php echo $toc->toc(); ?>
      </div>
    </div>
  </div>
  @endif
</div>
@endsection
