<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">比赛</h3>
  </div>
  <ul class="list-group">
    @php
    // $contests = \App\CodeforcesContest::orderBy('startTimeSeconds')->where('startTimeSeconds', '>=', time() - 7200)->get();
    // foreach ($contests as $contest) {
    //     $contest['oj'] = 'codeforces';
    // }
    $infos = \App\InfoContest::filter();
    foreach ($infos as $info) {
        $info['startTimeSeconds'] = strtotime($info['start_time']);
    }
    // $contests = $contests->merge($infos);
    $contests = $infos;
    @endphp
    @foreach($contests->sortBy('startTimeSeconds') as $contest)
    <li class="list-group-item">
      <h4 class="hidden text-center">
        @if ($info['startTimeSeconds'] >= time())
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
          {{ \App\Utilities\Functions::relative_time($contest['startTimeSeconds'] - time()) }}
        </small>
      </div>
      <div class="text-center @if ($info['startTimeSeconds'] < time()) text-danger @endif">
        <small>
          {{ date('l, F jS H:i', $contest['startTimeSeconds']) }},
          {{ \App\Utilities\Functions::relative_time($contest['startTimeSeconds'] - time()) }}
        </small>
      </div>
      <div class="text-center">
        <small>
          {{-- <a href="http://codeforces.com" style="color: inherit; text-decoration: inherit;"> --}}
            {{-- codeforces.com --}}
          <a href="//{{ parse_url($contest->link)['host'] }}" style="color: inherit; text-decoration: inherit;">
            {{-- {{ $contest['oj'] }} --}}
            {{ parse_url($contest->link)['host'] }}
          </a>
        </small>
      </div>
    </li>
    @endforeach
    <li class="list-group-item text-center">
      <small><a href="/contest" style="color: inherit; text-decoration: inherit;">查看全部</a></small>
    </li>
  </ul>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Recent actions</h3>
  </div>
  <div class="panel-body">
    <a href="#">Infinity</a> created the world
  </div>
</div>
