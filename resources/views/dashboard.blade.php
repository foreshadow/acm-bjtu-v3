@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">个人信息</h3>
        </div>
        <div class="panel-body">
          <div class="avatar avatar-lg pull-left">
            <img src="{{ Auth::user()->url() }}">
          </div>
          <p>
            <strong><a href="/user/{{ Auth::id() }}">{{ Auth::user()->name }}</a></strong>
            <br>
            <small>{{ Auth::user()->email }}</small>
          </p>
          <a href="/user/{{ Auth::id() }}/edit" class="btn btn-sm btn-primary pull-right">@icon('pencil')修改</a>
        </div>
      </div>
      @if (Auth::user()->codeforces_user)
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Codeforces</h3>
        </div>
        <ul class="list-group">
          <li class="list-group-item no-margin {{ Auth::user()->codeforces_user->codeforces_rank_color_class() }}">
            <!-- <img src="{{ Auth::user()->codeforces_user->avatar }}" style="max-width: 46px; max-height: 46px; border-radius: 3px; float: left;"> -->
            <p class="pull-right" style="font-family: verdana; font-weight: bold;">{{ Auth::user()->codeforces_user->rating }}</p>
            <p style="font-family: verdana; font-weight: bold;">{{ ucwords(Auth::user()->codeforces_user->rank) }}</p>
            <p class="rated-user" style="font-size: 2rem;">{{ Auth::user()->codeforces_user->handle }}</p>
          </li>
          @php $statuses = \App\CodeforcesStatus::where('handle', '=', Auth::user()->handle)->orderBy('creationTimeSeconds', 'desc')->take(6)->get(); @endphp
          @for ($i = 0, $n = count($statuses); $i < $n; $i += 1)
          @php $status = $statuses[$i]; @endphp
          @if ($i == 0 || $status->uid() != $statuses[$i - 1]->uid())
          <li class="list-group-item problem-status">
            <h5 class="inline">{{ $status->contestId }}{{ $status->index }} {{ $status->name }}</h5>
          @endif
            <div>
              <small class="pull-right">{{ date('M/d H:i', $status->creationTimeSeconds) }}</small>
              <small class="verdict {{ $status->codeforces_verdict_class() }}">{{ $status->codeforces_verdict(false) }}</small>
            </div>
          @if ($i == $n - 1 || $status->uid() != $statuses[$i + 1]->uid())
          </li>
          @endif
          @endfor
        </ul>
      </div>
      @endif
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Pastebin</h3>
        </div>
        <div class="panel-body">
          <a href="/pastebin/create" class="btn btn-sm btn-success">@icon('plus')新建</a>
          <a href="/pastebin" class="btn btn-sm btn-info">@icon('zoom-in')查看全部</a>
        </div>
        <ul class="list-group">
          @forelse ($snippets as $snippet)
          <li class="list-group-item">
            <div class="pull-right">{{ $snippet->created_at }}</div>
            <div><a href="/pastebin/{{ $snippet->id }}">{{ $snippet->title }}</a></div>
          </li>
          @empty
          <li class="list-group-item">Create a snippet!</li>
          @endforelse
        </ul>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body">
          <h3>{{ App\Functions::greetings() }}，{{ Auth::user()->name }}。</h3>
          <!-- 四点以后就早安了-.- 十点后就夜深了-->
          <hr class="hidden">
          <div class="row hidden">
            <div class="col-md-4">
              <div class="panel panel-primary">
                <div class="panel-heading sm">
                  <div class="row">
                    <div class="col-xs-3" style="font-size: 40px; line-height: 8px;">@icon('envelope')</div>
                    <div class="col-xs-9">
                      <div class="text-right" style="font-size: 20px;">12</div>
                      <div class="text-right">新消息</div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer sm">查看<span class="pull-right">@icon('chevron-right')</span></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-info">
                <div class="panel-heading sm">
                  <div class="row">
                    <div class="col-xs-3" style="font-size: 40px; line-height: 8px;">@icon('comment')</div>
                    <div class="col-xs-9">
                      <div class="text-right" style="font-size: 20px;">23</div>
                      <div class="text-right">新回复</div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer sm">查看<span class="pull-right">@icon('chevron-right')</span></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="panel panel-success">
                <div class="panel-heading sm">
                  <div class="row">
                    <div class="col-xs-3" style="font-size: 40px; line-height: 8px;">@icon('bell')</div>
                    <div class="col-xs-9">
                      <div class="text-right" style="font-size: 20px;">34</div>
                      <div class="text-right">新通知</div>
                    </div>
                  </div>
                </div>
                <div class="panel-footer sm">查看<span class="pull-right">@icon('chevron-right')</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">文章</h3>
        </div>
        <div class="panel-body">
          <a href="/article/create" class="btn btn-sm btn-success">@icon('plus')新建</a>
          <a href="/article" class="btn btn-sm btn-info">@icon('zoom-in')查看全部</a>
        </div>
        <ul class="list-group">
          @forelse ($articles as $article)
          <li class="list-group-item">
            <a href="/article/{{ $article->id }}/edit" class="btn btn-sm btn-primary pull-right">@icon('pencil')编辑</a>
            <h4><a href="/article/{{ $article->id }}">{{ $article->title }}</a></h4>
          </li>
          @empty
          <li class="list-group-item">没有文章</li>
          @endforelse
        </ul>
      </div>
    </div>
    <div class="col-md-3">
      @include('attention')
    </div>
  </div>
</div>
@endsection
