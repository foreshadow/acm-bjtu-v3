@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="visible-xs">
        @include('attention')
      </div>
      <div class="hidden-xs">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">在线比赛</h3>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th></th>
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
                  <td></td>
                  <td>{{ $contest->oj }}</td>
                  <td>
                    <a href="{{ $contest->link }}">{{ $contest['name'] }}</a>
                  </td>
                  <td class="@if ($contest['startTimeSeconds'] < time()) text-danger @endif">
                    <small>{{ date('l, F jS H:i', $contest['startTimeSeconds']) }}</small>
                  </td>
                  <td>
                    <small>{{ relative_time($contest['startTimeSeconds'] - time()) }}</small>
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
    </div>
  </div>
</div>
@endsection
