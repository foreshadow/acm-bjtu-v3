<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">在线比赛</h3>
  </div>
  <ul class="list-group">
    @foreach (App\InfoContest::filter(4) as $contest)
    <li class="list-group-item">
      <h4 class="hidden text-center">
        @if ($contest['startTimeSeconds'] >= time())
        Before contest
        @else
        Contest is running
        @endif
      </h4>
      <div class="no-margin text-center">
        {{-- <a href="//codeforces.com/contests/{{ $contest->id }}"> --}}
        <a href="{{ $contest->link }}">
          {{ $contest['name'] }}
        </a>
      </div>
      <div class="text-center hidden">
        <small>
          {{ date('D M/d/Y H:i', $contest['startTimeSeconds']) }}
          (+{{ sprintf("%s:%02s", $contest['durationSeconds'] / 3600, $contest['durationSeconds'] % 3600 / 60) }})
        </small>
        <!-- <small class="pull-right"> -->
        <small>
          {{ relative_time($contest['startTimeSeconds'] - time()) }}
        </small>
      </div>
      <div class="text-center @if ($contest['startTimeSeconds'] < time()) text-danger @endif">
        <small>
          {{ date('l, F jS H:i', $contest['startTimeSeconds']) }},
          {{ relative_time($contest['startTimeSeconds'] - time()) }}
        </small>
      </div>
      <div class="text-center">
        <small>
          {{-- <a href="http://codeforces.com" class="link-initial"> --}}
            {{-- codeforces.com --}}
          <a href="//{{ parse_url($contest->link)['host'] }}" class="link-initial">
            {{-- {{ $contest['oj'] }} --}}
            {{ parse_url($contest->link)['host'] }}
          </a>
        </small>
      </div>
    </li>
    @endforeach
    <li class="list-group-item text-center" style="padding: 3px;">
      <small><a href="/contest" class="link-initial">查看全部</a></small>
    </li>
  </ul>
</div>
<div class="panel panel-default hidden">
  <div class="panel-heading">
    <h3 class="panel-title">Recent actions</h3>
  </div>
  <div class="panel-body">
    <a href="#">Infinity</a> created the world
  </div>
</div>
