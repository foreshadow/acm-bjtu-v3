@extends('layouts.md')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">新建题目</h3>
      </div>
      <div class="panel-body">
        <form action="/problem" method="post">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="title">标题</label>
            <input type="text" name="title" id="title" class="form-control" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="time">时间限制</label>
              <div class="input-group">
                <input type="text" name="time" id="time" class="form-control" value="1000" required>
                <span class="input-group-addon">ms</span>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="memory">内存限制</label>
              <div class="input-group">
                <input type="text" name="memory" id="memory" class="form-control" value="64" required>
                <span class="input-group-addon">MB</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="description">描述</label>
            <textarea name="description" rows="3" id="description" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="input">输入</label>
            <textarea name="input" rows="3" id="input" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="output">输出</label>
            <textarea name="output" rows="3" id="output" class="form-control" required></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="sample-in">样例输入</label>
              <textarea name="sample_in" rows="3" id="sample-in" class="col-md-6 form-control" required></textarea>
            </div>
            <div class="col-md-6 form-group">
              <label for="sample-out">样例输出</label>
              <textarea name="sample_out" rows="3" id="sample-out" class="col-md-6 form-control" required></textarea>
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
    $(to).html(markdown.toHTML($(from).val()));
}
bind("#title", "#preview-title");
bind("#description", "#preview-description");
bind("#input", "#preview-input");
bind("#output", "#preview-output");
bind("#sample-in", "#preview-sample-in");
bind("#sample-out", "#preview-sample-out");
$("#time").keyup(function () {
    $("#preview-time").html($(this).val());
});
$("#preview-time").html($("#time").val());
$("#memory").keyup(function () {
    $("#preview-memory").html($(this).val());
});
$("#preview-memory").html($("#memory").val());
</script>
@endpush
