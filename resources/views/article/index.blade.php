@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">文章管理</h3>
        </div>
        <div class="panel-body">
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            {!! implode('<br>', $errors->all()) !!}
          </div>
          @endif
          <a href="/article/create" class="btn btn-sm btn-success">@icon('plus')新建</a>
        </div>
        <ul class="list-group">
          @foreach ($articles as $article)
          <li class="list-group-item">
            <div class="pull-right">
              <a href="/article/{{ $article->id }}/edit" class="btn btn-sm btn-primary">@icon('pencil')编辑</a>
              <form action="/article/{{ $article->id }}" method="POST" style="display: inline;">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger">@icon('trash')删除</button>
              </form>
            </div>
            <div class="article">
              <h4>
                <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
                <small>{{ $article->info() }}</small>
              </h4>
              <div class="content">
                <?php echo $article->text(3); ?>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
