<div class="problem-print">
  <div class="aspect-ratio">
    <div class="page">
      <header>
        <p class="contest-title">第十一届ACM程序设计竞赛<br>北京交通大学，2017年4月15日 </p>
        <hr>
      </header>
      <article>
        <h3 class="problem-title">
          {{ $problem->title }}
        </h3>
        <div class="problem-limits">
        	时间限制：{{ $problem->time }} ms<br>
        	内存限制：{{ $problem->memory }} M
        </div>
        <div class="problem-description">
          {{ $problem->description }}
        </div>
        <h4 class="subtitle">输入</h4>
        <div class="problem-input">
          {{ $problem->input }}
        </div>
        <h4 class="subtitle">输出</h4>
        <div class="problem-output">
          {{ $problem->output }}
        </div>
        <h4 class="subtitle">样例</h4>
        <table>
          <thead>
            <tr>
              <td>标准输入</td>
              <td>标准输出</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="sample-input">
                  {{ $problem->sample_in }}
                </div>
              </td>
              <td>
                <div class="sample-output">
                  {{ $problem->sample_out }}
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </article>
      <footer>
        <hr>
        <div class="page-number">第 1 页，共 1 页</div>
      </footer>
    </div>
  </div>
</div>

@push('head')
<link href="/css/print.css" rel="stylesheet">
@endpush
