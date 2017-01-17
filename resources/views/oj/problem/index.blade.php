@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">Problem list</div>
      </div>
    </div>
    <div class="col-md-3">
     @include('attention')
    </div>
  </div>
</div>
@endsection
