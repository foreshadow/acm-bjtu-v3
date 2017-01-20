@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Pastebin</h3>
        </div>
        <div class="panel-body">
          @if (count($errors) > 0)
          <div class="alert alert-danger">
            {!! implode('<br>', $errors->all()) !!}
          </div>
          @endif
          <a href="/pastebin/create" class="btn btn-sm btn-success">@icon('plus')新建</a>
        </div>
        <ul class="list-group">
          @foreach ($snippets as $snippet)
          <li class="list-group-item">
            <div class="article">
              <p class="pull-right">
                {{ $snippet->created_at }}
              </p>
              <h4>
                <a href="/pastebin/{{ $snippet->id }}">{{ $snippet->title }}</a>
              </h4>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
