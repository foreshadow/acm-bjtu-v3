@extends('layouts.md')

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
          @if ($problem->user_id == Auth::id() || Auth::user()->hasRole('superadmin'))
            <li role="presentation" class="pull-right">
              <form action="/problem/{{ $problem->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger" data-confirm="确定要删除题目 {{ $problem->title }} 吗？">@icon('trash')删除</button>
              </form>
            </li>
          @endif
          <li role="presentation" class="pull-right">
            <button href="/problem/{{ $problem->id }}/edit" class="btn btn-primary">@icon('pencil')修改</button>
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
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">文件</h3>
      </div>
      <div class="panel-body">
        @if ($problem->generator)
          <h4>
            <a href="{{ Storage::url($problem->generator) }}">{{ ucfirst(explode('/', $problem->generator)[3]) }}</a>
            <div class="pull-right"><small>{{ Storage::size($problem->generator) }} 字节</small></div>
            <div><small>修改于 {{  date('Y/n/j G:i', Storage::lastModified($problem->generator)) }}</small></div>
          </h4>
          {{-- <pre><code>{{ substr(Storage::get($problem->generator), 0, 256) }}</code></pre> --}}
        @else
          No generator
        @endif
        <hr>
        @if ($problem->solution)
          <h4>
            <a href="{{ Storage::url($problem->solution) }}">{{ ucfirst(explode('/', $problem->solution)[3]) }}</a>
            <div class="pull-right"><small>{{ Storage::size($problem->solution) }} 字节</small></div>
            <div><small>修改于 {{  date('Y/n/j G:i', Storage::lastModified($problem->solution)) }}</small></div>
          </h4>
          {{-- <pre><code>{{ substr(Storage::get($problem->solution), 0, 256) }}</code></pre> --}}
        @else
          No solution
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
