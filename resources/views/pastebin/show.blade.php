@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        @if ($snippet->title)
        <div class="panel-heading">
          {{ $snippet->title }}
        </div>
        @endif
        <div class="panel-body">
          <pre><code>{{ $snippet->body }}</code></pre>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
