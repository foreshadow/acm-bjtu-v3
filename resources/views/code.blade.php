<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/styles/github-gist.min.css">
<h4 style="display: inline;">{{ $path }}</h4> <small><a href="{{ Storage::url($path) }}">raw</a></small>
<hr>
<pre><code style="background: white; font-size: 14px; font-family: Consolas, Menlo, Courier, monospace;">{{ $content }}</code></pre>

<!-- Markdown code highlighter -->
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.3.0/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
