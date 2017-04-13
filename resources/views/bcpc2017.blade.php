@extends('layouts.transparent')

@section('content')
<div class="bcpc2017">
  <div class="register">
    @if ($contest->registration())
      <a class="btn btn-success btn-lg" href="/onsite/1">@icon('ok')已报名</a>
    @elseif (in(sqlnow(), $contest->begin_register_at, $contest->end_register_at))
      <a class="btn btn-default btn-lg" href="/onsite/1">@icon('send')立即报名</a>
    @endif
  </div>
</div>
@endsection
