<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">

  <!-- Scripts -->
  <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <!-- Branding Image -->
          <a class="navbar-brand" href="/">
            {{ config('app.name', 'Laravel') }}
          </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
          <!-- Left Side Of Navbar -->
          <ul class="nav navbar-nav">
            <li><a href="/">首页</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">测评 <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="/oj">测评首页</a></li>
                <li><a href="/oj/problem">题目列表</a></li>
                <li><a href="/oj/submission">提交状态</a></li>
              </ul>
            </li>
            <li><a href="/blog">博客</a></li>
            <li><a href="/user">用户</a></li>
            <li><a href="/report">反馈</a></li>
            <li><a href="/pastebin">Pastebin</a></li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
            <li><a href="/login">登录</a></li>
            <li><a href="/register">注册</a></li>
            @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <strong>{{ Auth::user()->name }}</strong>
                <small>{{ Auth::user()->email }}</small>
                <span class="caret"></span>
              </a>

              <ul class="dropdown-menu" role="menu">
                <li><a href="/dashboard">个人中心</a></li>
                <li class="divider"></li>
                <li>
                  <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">退出登录</a>
                  <form id="logout-form" action="/logout" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </li>
              </ul>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    @yield('content')
  </div>

  <!-- Scripts -->
  <script src="/js/app.js"></script>
  @stack('scripts')
</body>

</html>
