<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Pay attention</h3>
  </div>
  <ul class="list-group">
    @php $contests = \App\CodeforcesContest::orderBy('startTimeSeconds')->where('startTimeSeconds', '>=', time())->take(3)->get(); @endphp
    @foreach($contests->sortBy('startTimeSeconds') as $contest)
    <li class="list-group-item">
      <h4 class="text-center">Before contest
        <small>{{ \App\Utilities\Functions::relative_time($contest['startTimeSeconds'] - time()) }}</small>
      </h4>
      <p class="inline no-margin text-center">
        <a href="//codeforces.com/contests/{{ $contest->id }}">
          {{ $contest['name'] }}
        </a>
      </p>
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
      <p class="text-center">
        <small>
          <a href="http://codeforces.com" style="color: inherit; text-decoration: inherit;">codeforces.com</a>
        </small>
      </p>
    </li>
    @endforeach
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
