<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', config('app.name'))</title>

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">

  @stack('head')

  <!-- Scripts -->
  <script>window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>
</head>

<body>
  <div id="app">
    @section('navbar')
      <nav class="navbar navbar-transparent navbar-static-top">
        <div class="navbar-shadow-box"></div>
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
              {{-- <li><a href="/blog">博客</a></li> --}}
              {{-- <li><a href="/contest">比赛</a></li> --}}
              {{-- <li><a href="/user">用户</a></li> --}}
              {{-- <li><a href="/report">反馈</a></li> --}}
              {{-- <li><a href="/pastebin">Pastebin</a></li> --}}
              <li><a href="/onsite">校赛报名</a></li>
              @role('bjtuacm')
              <li><a href="/problem">校赛出题</a></li>
              @endrole
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
      @elseif (count($errors) > 0)
        <div class="alert alert-fluid alert-dismissible alert-danger">
          <div class="container">
            <button type="button" class="close" data-dismiss="alert">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <span>
              <span class="glyphicon glyphicon-remove"></span>&emsp;
              @foreach ($errors->all() as $error)
                {{ $error }}
              @endforeach
            </span>
          </div>
        </div>
      @endif
    @show
    <div class="container">
      @yield('content')
    </div>
    <div class="container">
      <hr>
      <footer>
        <small>&copy; 2017 Infinity</small>
      </footer>
      <br>
    </div>
  </div>

  <!-- Scripts -->
  <!-- <script src="/js/app.js"></script> -->

  <!-- jQuery -->
  <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>

  <!-- jQuery Extension: jQuery confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.0.3/jquery-confirm.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <script type="text/javascript">
  $(document).ready(function() {
      $('a[href^="http"]').each(function() {
          $(this).attr('target', '_blank');
      });
      $('a[href^="//"]').each(function() {
          $(this).attr('target', '_blank');
      });
      $('a[href^="https://bjtuacm.org"]').each(function() {
          $(this).removeAttr('target');
      });
      $('button[href]').each(function() {
          $(this).attr('onclick', 'window.location.href="' + $(this).attr('href') + '";');
      });
      $('[data-toggle="tooltip"]').tooltip({
          html: true
      });
      jconfirm.defaults = {
          theme: 'infinity'
      };
      $('[data-confirm]').click(function() {
          event.preventDefault();
          var form = $(this).parent();
          $.confirm({
              title: '删除',
              content: $(this).attr('data-confirm'),
              buttons: {
                  confirm: {
                      text: '删除',
                      btnClass: 'btn-danger',
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
