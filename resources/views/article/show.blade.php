@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container">
  <div class="row">
    @if ($article->toc)
    <div class="col-md-9">
    @else
    <div class="col-md-8 col-md-offset-2">
    @endif
      <div id="content">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>{{ $article->title }}</h3>
            @if (Auth::check() && Auth::id() == $article->user_id)
            <a href="/article/{{ $article->id }}/edit" class="btn btn-sm btn-primary pull-right">@icon('pencil')编辑</a>
            @endif
            <p>{!! $article->creator->link() !!} <small>{{ $article->info() }}</small></p>
          </div>
          <div class="panel-body">
            @if ($article->renderer == 'markdown')
            <?php $toc = new App\TOC($article->gfm(), $article->label); echo $toc->html(); ?>
            @else
            <?php $toc = new App\TOC($article->body, $article->label); echo $toc->html(); ?>
            @endif
          </div>
        </div>
      </div>
    </div>
    @if ($article->toc)
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>目录</h4>
        </div>
        <div class="panel-body">
          <?php echo $toc->toc(); ?>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection

@push('scripts')
<!-- MathJax -->
<script type="text/x-mathjax-config">MathJax.Hub.Config({ tex2jax: { inlineMath: [['$','$'], ["\\(","\\)"] ], processEscapes: true } });</script>
<script type="text/x-mathjax-config">MathJax.Hub.Config({ tex2jax: { skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code'] } });</script>
<script type="text/x-mathjax-config">MathJax.Hub.Queue(function() { var all = MathJax.Hub.getAllJax(), i; for (i=0; i < all.length; i += 1) { all[i].SourceElement().parentNode.className += 'has-jax'; }});</script>
<script src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>

<!-- Markdown code highlighter -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/github.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
@endpush
