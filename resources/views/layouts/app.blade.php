<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name')) - {{ config('app.name') }}</title>

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">

  <!-- jQuery confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.css">

  <!-- Scripts -->
  <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>
</head>

<body>
  <div id="app">
    @section('navbar')
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
                <div class="avatar avatar-sm">
                  <img src="{{ Auth::user()->url() }}">
                </div>
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
    @show
    @if (session('alert') !== null)
    <div class="alert alert-fluid alert-dismissible alert-{{ session('alert')['type'] }}">
      <div class="container">
        <button type="button" class="close" data-dismiss="alert">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <span>
        @if (isset(session('alert')['icon']))
          <span class="glyphicon glyphicon-{{ session('alert')['icon'] }}"></span>&emsp;{{ session('alert')['message'] }}
        @else
        {{ session('alert')['message'] }}
        @endif
        </span>
      </div>
    </div>
    @endif
    @yield('content')
  </div>

  <!-- Scripts -->
  <!-- <script src="/js/app.js"></script> -->

  <!-- jQuery -->
  <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
  <!-- jQuery Extension -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="//cdn.bootcss.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  $(document).ready(function() {
      $('a[href^="http"]').each(function() {
          $(this).attr('target', '_blank');
      });
      $('[data-toggle="tooltip"]').tooltip({
          html: true
      });
      jconfirm.defaults = {
          bgOpacity: .55,
      };
      $('[data-confirm]').click(function() {
          event.preventDefault();
          var form = $(this).parent();
          $.confirm({
              title: '',
              content: $(this).attr('data-confirm'),
              buttons: {
                  confirm: {
                      text: '删除',
                      btnClass: 'btn-sm btn-danger',
                      action: function () {
                          form.submit();
                      }
                  },
                  cancel: {
                      text: '取消',
                      action: function () {
                          event.preventDefault();
                      }
                  }
              }
          });
      });
  });
  </script>
  @stack('scripts')
</body>

</html>
