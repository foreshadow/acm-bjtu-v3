@extends('layouts.md')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">新建题目</h3>
      </div>
      <div class="panel-body">
        <form action="/problem/{{ $problem->id }}" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="form-group form-group-sm">
            <label for="title">标题</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $problem->title }}" required>
          </div>
          <div class="row">
            <div class="form-group form-group-sm col-md-6">
              <label for="time">时间限制</label>
              <div class="input-group">
                <input type="text" name="time" id="time" class="form-control" value="{{ $problem->time }}" required>
                <span class="input-group-addon">ms</span>
              </div>
            </div>
            <div class="form-group form-group-sm col-md-6">
              <label for="memory">内存限制</label>
              <div class="input-group">
                <input type="text" name="memory" id="memory" class="form-control" value="{{ $problem->memory }}" required>
                <span class="input-group-addon">MB</span>
              </div>
            </div>
          </div>
          <div class="form-group form-group-sm">
            <label for="description">描述</label>
            <textarea name="description" rows="3" id="description" class="form-control" required>{{ $problem->description }}</textarea>
          </div>
          <div class="form-group form-group-sm">
            <label for="input">输入</label>
            <textarea name="input" rows="3" id="input" class="form-control" required>{{ $problem->input }}</textarea>
          </div>
          <div class="form-group form-group-sm">
            <label for="output">输出</label>
            <textarea name="output" rows="3" id="output" class="form-control" required>{{ $problem->output }}</textarea>
          </div>
          <div class="row">
            <div class="col-md-6 form-group form-group-sm">
              <label for="sample-in">样例输入</label>
              <textarea name="sample_in" rows="3" id="sample-in" class="col-md-6 form-control">{{ $problem->sample_in }}</textarea>
            </div>
            <div class="col-md-6 form-group form-group-sm">
              <label for="sample-out">样例输出</label>
              <textarea name="sample_out" rows="3" id="sample-out" class="col-md-6 form-control" required>{{ $problem->sample_out }}</textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group form-group-sm">
              {{ Form::label('generator', '数据生成器') }}
              {{ Form::file('generator', ['id' => 'generator']) }}
              <span class="help-block">用来生成标准输入</span>
            </div>
            <div class="col-md-6 form-group form-group-sm">
              {{ Form::label('solution', '标程') }}
              {{ Form::file('solution', ['id' => 'solution']) }}
              <span class="help-block">用来生成标准输出</span>
            </div>
          </div>
          <button type="submit" class="btn btn-sm btn-primary">@icon('send')提交</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">预览</h3>
      </div>
      <div class="panel-body">
        @include('problem.markdown')
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/js/markdown.min.js"></script>
<script>
function bind(from, to) {
    $(from).keyup(function () {
        $(to).html(markdown.toHTML($(this).val()));
        MathJax.Hub.Queue(["Typeset", MathJax.Hub, to.substr(1)]);
    });
}
function bindraw(from, to) { $(from).keyup(function () { $(to).html($(this).val()); }); }
bind("#title", "#preview-title");
bindraw("#time", "#preview-time");
bindraw("#memory", "#preview-memory");
bind("#description", "#preview-description");
bind("#input", "#preview-input");
bind("#output", "#preview-output");
bindraw("#sample-in", "#preview-sample-in");
bindraw("#sample-out", "#preview-sample-out");
</script>
@endpush
