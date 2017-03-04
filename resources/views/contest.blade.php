@extends('layouts.app')

@section('content')
  @php
  $infos = \App\InfoContest::filter(100);
  foreach ($infos as $info) {
    $info['startTimeSeconds'] = strtotime($info['start_time']);
  }
  $contests = $infos;
  @endphp
  <div class="container">
    <div class="col-md-8 col-md-offset-2">
      <h3>所有比赛</h3>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>网站</th>
            <th>比赛</th>
            <th>时间</th>
            <th></th>
            <th class="hidden">链接</th>
          </tr>
        </thead>
        <tbody>
          @foreach($contests as $contest)
            <tr>
              <td>{{ $contest->oj }}</td>
              <td>
                <a href="{{ $contest->link }}">{{ $contest['name'] }}</a>
              </td>
              <td class="@if ($info['startTimeSeconds'] < time()) text-danger @endif">
                <small>{{ date('l, F jS H:i', $contest['startTimeSeconds']) }}</small>
              </td>
              <td>
                <small>{{ \App\Utilities\Functions::relative_time($contest['startTimeSeconds'] - time()) }}</small>
              </td>
              <td class="hidden">
                <small><a href="//{{ parse_url($contest->link)['host'] }}">{{ parse_url($contest->link)['host'] }}</a></small>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
