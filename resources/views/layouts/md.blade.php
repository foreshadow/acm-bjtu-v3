@extends('layouts.app')

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
