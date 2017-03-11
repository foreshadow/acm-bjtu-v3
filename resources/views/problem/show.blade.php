@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-body">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#markdown" aria-controls="markdown" role="tab" data-toggle="tab">网页预览</a>
          </li>
          <li role="presentation">
            <a href="#print" aria-controls="print" role="tab" data-toggle="tab">打印预览</a>
          </li>
          <li role="presentation" class="pull-right">
            <a href="/problem/{{ $problem->id }}/edit" class="bg-primary">@icon('pencil')修改</a>
          </li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="markdown">
            @include('problem.markdown')
          </div>
          <div role="tabpanel" class="tab-pane" id="print">
            @include('print')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
