@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Problem list</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
     @include('attention')
    </div>
  </div>
</div>
@endsection
