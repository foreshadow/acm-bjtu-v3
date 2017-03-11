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
            <input type="text" id="title" class="form-control" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="title">时间限制</label>
              <div class="input-group">
                <input type="text" id="time" class="form-control" value="1000" required>
                <span class="input-group-addon">ms</span>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="title">内存限制</label>
              <div class="input-group">
                <input type="text" id="memory" class="form-control" value="64" required>
                <span class="input-group-addon">MB</span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="title">描述</label>
            <textarea name="name" rows="3" id="description" class="form-control" required>Hello world!</textarea>
          </div>
          <div class="form-group">
            <label for="title">输入</label>
            <textarea name="name" rows="3" id="input" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="title">输出</label>
            <textarea name="name" rows="3" id="output" class="form-control" required></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="title">样例输入</label>
              <textarea name="name" rows="3" id="sample-in" class="col-md-6 form-control" required></textarea>
            </div>
            <div class="col-md-6 form-group">
              <label for="title">样例输出</label>
              <textarea name="name" rows="3" id="sample-out" class="col-md-6 form-control" required></textarea>
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
        <h3 id="preview-title"></h3>
        <small>
          时间限制 <span id="preview-time"></span> ms<br>
          内存限制 <span id="preview-memory"></span> MB
        </small>
        <h4 class="text-primary">题目描述</h4>
        <div id="preview-description"></div>
        <h4 class="text-primary">输入数据</h4>
        <div id="preview-input"></div>
        <h4 class="text-primary">输出数据</h4>
        <div id="preview-output"></div>
        <h4 class="text-primary">样例输入</h4>
        <div><pre><code id="preview-sample-in"></code></pre></div>
        <h4 class="text-primary">样例输出</h4>
        <div><pre><code id="preview-sample-out"></code></pre></div>
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
