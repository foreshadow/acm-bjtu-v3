@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h3>
        @role('admin')
          <a href="/onsite/create" class="btn btn-sm btn-success pull-right">@icon('plus')新建</a>
        @endrole
        比赛列表
      </h3>
      @foreach ($onsites as $contest)
        <div class="list-group">
          <div class="list-group-item">
            <div class="pull-right">{{ $contest->registrants()->count() }}人已报名</div>
            <h4 class="list-group-item-heading"><a href="/onsite/{{ $contest->id }}">{{ $contest->title }}</a></h4>
            @if ($contest->registration())
              <a href="/onsite/{{ $contest->id }}" class="btn btn-sm btn-success pull-right">@icon('ok')已报名</a>
            @elseif (in(sqlnow(), $contest->begin_register_at, $contest->end_register_at))
              <a href="/onsite/{{ $contest->id }}" class="btn btn-sm btn-primary pull-right">@icon('send')立即报名</a>
            @endif
            <p class="list-group-item-text">
              {{ $contest->begin_at }}<br>
              {{ $contest->location }}
            </p>
          </div>
        </div>
      @endforeach
    </div>
    <div class="col-md-3">
      @include('attention')
    </div>
  </div>
</div>
@endsection
