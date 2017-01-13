@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">文章管理</div>
        <div class="panel-body">
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            {!! implode('<br>', $errors->all()) !!}
          </div>
          @endif
          <a href="{{ url('article/create') }}" class="btn btn-primary">写文章</a>
          @foreach ($articles as $article)
          <hr>
          <div class="pull-right">
            <a href="{{ url('article/'.$article->id . '/edit') }}" class="btn btn-success">编辑</a>
            <form action="{{ url('article/' . $article->id) }}" method="POST" style="display: inline;">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button type="submit" class="btn btn-danger">删除</button>
            </form>
          </div>
          <div class="article">
            <h4>
              <a href="{{ url('article/' . $article->id) }}">{{ $article->title }}</a>
              <small>{{ $article->info() }}</small>
            </h4>
            <div class="content">
              <?php echo $article->text(3); ?>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
