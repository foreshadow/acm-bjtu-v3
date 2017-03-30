<h3 id="preview-title">{{ $problem->title or '' }}</h3>
<small>
  时间限制 <span id="preview-time">{{ $problem->time or 1000 }}</span> ms<br>
  内存限制 <span id="preview-memory">{{ $problem->memory or 64 }}</span> MB
</small>
<h4 class="text-primary">题目描述</h4>
<div id="preview-description">
  @if (isset($problem))
    {!! markdownify($problem->description) !!}
  @endif
</div>
<h4 class="text-primary">输入数据</h4>
<div id="preview-input">
  @if (isset($problem))
    {!! markdownify($problem->input) !!}
  @endif
</div>
<h4 class="text-primary">输出数据</h4>
<div id="preview-output">
  @if (isset($problem))
    {!! markdownify($problem->output) !!}
  @endif
</div>
<h4 class="text-primary">样例输入</h4>
<div>
  <pre><code id="preview-sample-in">{{ $problem->sample_in or '' }}</code></pre>
</div>
<h4 class="text-primary">样例输出</h4>
<div>
  <pre><code id="preview-sample-out">{{ $problem->sample_out or '' }}</code></pre>
</div>
