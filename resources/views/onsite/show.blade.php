@extends('layouts.md')

@section('content')
<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-body">
        <h4>
          {{ $contest->title }}
          @if ($contest->registration())
            <div class="pull-right">
              @role('admin')
              <a href="/onsite/{{ $contest->id }}/edit" class="btn btn-sm btn-primary">@icon('pencil')修改</a>
              @endrole
              <a class="btn btn-sm btn-success disabled" style="opacity: 1;">@icon('ok')已报名</a>
            </div>
          @endif
        </h4>
        <div>
          @icon('time'){{ $contest->begin_at }} ~ {{ $contest->end_at }}<br>
          @icon('home'){{ $contest->location }}<br>
          @icon('user'){{ $contest->registrants()->count() }}
        </div>
        <small>报名时间 {{ $contest->begin_register_at }} ~ {{ $contest->end_register_at }}</small>
        <hr>
        <div>{!! (new Parsedown())->text($contest->body) !!}</div>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          @if ($contest->registration())
            修改报名信息
          @else
            报名
          @endif
        </h3>
      </div>
      <div class="panel-body">
        @if (in(sqlnow(), $contest->begin_register_at, $contest->end_register_at))
          @if ($registration = $contest->registration())
            <form action="/onsite/{{ $contest->id }}/register/{{ $registration->id }}" method="post" class="form-horizontal">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="form-group">
                <label class="col-md-3 control-label" for="realname">姓名</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="realname" class="input-sm form-control" type="text" name="realname"
                   value="{{ $registration->realname }}" required readonly>
                </div>
              </div>
              @if ($bjtu)
                <div class="form-group">
                  <label class="col-md-3 control-label" for="sid">学号</label>
                  <div class="col-md-9" style="padding-left: 0;">
                    <input id="sid" class="input-sm form-control" type="text" name="sid"
                     value="{{ $registration->sid }}" required readonly>
                  </div>
                </div>
              @endif
              <div class="form-group">
                <label class="col-md-3 control-label" for="location1">学校</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="location1" class="input-sm form-control" type="text" name="location1" placeholder="北京交通大学"
                   value="{{ $registration->location1 }}" required readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="location2">学院</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="location2" class="input-sm form-control" type="text" name="location2"
                   value="{{ $registration->location2 }}" required readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="email">邮箱</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="email" class="input-sm form-control" type="text" name="email"
                   value="{{ $registration->email }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="phone">手机</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="phone" class="input-sm form-control" type="text" name="phone"
                   value="{{ $registration->phone }}" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9 col-md-offset-2">
                  <button class="btn btn-sm btn-primary" type="submit" name="button">@icon('pencil')修改</button>
                </div>
              </div>
            </form>
          @elseif (Auth::check())
            <form action="/onsite/{{ $contest->id }}/register" method="post" class="form-horizontal">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="col-md-3 control-label" for="realname">姓名</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="realname" class="input-sm form-control" type="text" name="realname"
                   value="{{ Auth::user()->realname }}" required>
                </div>
              </div>
              @if ($bjtu)
                <div class="form-group">
                  <label class="col-md-3 control-label" for="sid">学号</label>
                  <div class="col-md-9" style="padding-left: 0;">
                    <input id="sid" class="input-sm form-control" type="text" name="sid"
                     placeholder="" value="{{ $sid }}" required readonly>
                  </div>
                </div>
              @endif
              <div class="form-group">
                <label class="col-md-3 control-label" for="location1">学校</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="location1" class="input-sm form-control" type="text" name="location1" placeholder="北京交通大学"
                   @if ($bjtu) value="北京交通大学" readonly @else value="{{ Auth::user()->location1 }}" @endif required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="location2">学院</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="location2" class="input-sm form-control" type="text" name="location2"
                   placeholder="计算机与信息技术学院" value="{{ Auth::user()->location2 }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="email">邮箱</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="email" class="input-sm form-control" type="text" name="email"
                   value="{{ Auth::user()->email }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 control-label" for="phone">手机</label>
                <div class="col-md-9" style="padding-left: 0;">
                  <input id="phone" class="input-sm form-control" type="text" name="phone"
                   value="{{ Auth::user()->phone }}" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9 col-md-offset-3" style="padding-left: 0;">
                  <button class="btn btn-sm btn-primary" type="submit" name="button">@icon('send')报名</button>
                </div>
              </div>
            </form>
          @else
            请先登录
          @endif
        @else
          {{-- out of register time --}}
          不在注册时间
        @endif
      </div>
    </div>
    @role('bjtuacm')
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">报名列表</h3>
      </div>
      <div class="panel-body">
        @foreach ($contest->registrations()->get() as $registration)
          <div>
            {{ $registration->realname }}
            @if ($registration->location1 == '北京交通大学')
              <small>{{ $registration->location2 }}</small>
            @else
              <small>{{ $registration->location1 }}</small>
            @endif
          </div>
        @endforeach
        <hr>
        <h4>统计</h4>
        @foreach ($contest->group()->get() as $registration)
          <div>
            {{ $registration->count }} 人 来自
            @if ($registration->location1 == '北京交通大学')
              <small>{{ $registration->location2 }}</small>
            @else
              <small>{{ $registration->location1 }}</small>
            @endif
          </div>
        @endforeach
      </div>
    </div>
    @endrole
  </div>
</div>
@endsection
