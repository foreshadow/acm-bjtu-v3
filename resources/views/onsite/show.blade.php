@extends('layouts.md')

@section('content')
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-body">
        <h4>
          {{ $contest->title }}
          <div class="pull-right">
            <small>{{ $contest->registrants()->count() }}人已报名</small>
            @if ($contest->registration())
              <a class="btn btn-sm btn-success disabled" style="opacity: 1;">@icon('ok')已报名</a>
            @endif
          </div>
        </h4>
        <p>{{ $contest->begin_at }}<br>{{ $contest->location }}</p>
        <small>报名时间 {{ $contest->begin_register_at }} ~ {{ $contest->end_register_at }}</small>
        <hr>
        <div>{!! (new Parsedown())->text($contest->body) !!}</div>
      </div>
    </div>
  </div>
  <div class="col-md-4">
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
                <label class="col-md-2 control-label" for="realname">姓名</label>
                <div class="col-md-10">
                  <input id="realname" class="input-sm form-control" type="text" name="realname"
                   value="{{ $registration->realname }}" required readonly>
                </div>
              </div>
              @if ($bjtu)
                <div class="form-group">
                  <label class="col-md-2 control-label" for="sid">学号</label>
                  <div class="col-md-10">
                    <input id="sid" class="input-sm form-control" type="text" name="sid"
                     value="{{ $registration->sid }}" required readonly>
                  </div>
                </div>
              @endif
              <div class="form-group">
                <label class="col-md-2 control-label" for="location1">学校</label>
                <div class="col-md-10">
                  <input id="location1" class="input-sm form-control" type="text" name="location1" placeholder="北京交通大学"
                   value="{{ $registration->location1 }}" required readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="location2">学院</label>
                <div class="col-md-10">
                  <input id="location2" class="input-sm form-control" type="text" name="location2"
                   value="{{ $registration->location2 }}" required readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="email">邮箱</label>
                <div class="col-md-10">
                  <input id="email" class="input-sm form-control" type="text" name="email"
                   value="{{ $registration->email }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="phone">手机</label>
                <div class="col-md-10">
                  <input id="phone" class="input-sm form-control" type="text" name="phone"
                   value="{{ $registration->phone }}" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                  <button class="btn btn-sm btn-primary" type="submit" name="button">@icon('pencil')修改</button>
                </div>
              </div>
            </form>
          @else
            <form action="/onsite/{{ $contest->id }}/register" method="post" class="form-horizontal">
              {{ csrf_field() }}
              <div class="form-group">
                <label class="col-md-2 control-label" for="realname">姓名</label>
                <div class="col-md-10">
                  <input id="realname" class="input-sm form-control" type="text" name="realname"
                   value="{{ Auth::user()->realname }}" required>
                </div>
              </div>
              @if ($bjtu)
                <div class="form-group">
                  <label class="col-md-2 control-label" for="sid">学号</label>
                  <div class="col-md-10">
                    <input id="sid" class="input-sm form-control" type="text" name="sid"
                     placeholder="" value="{{ $sid }}" required readonly>
                  </div>
                </div>
              @endif
              <div class="form-group">
                <label class="col-md-2 control-label" for="location1">学校</label>
                <div class="col-md-10">
                  <input id="location1" class="input-sm form-control" type="text" name="location1" placeholder="北京交通大学"
                   @if ($bjtu) value="北京交通大学" readonly @else value="{{ Auth::user()->location1 }}" @endif required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="location2">学院</label>
                <div class="col-md-10">
                  <input id="location2" class="input-sm form-control" type="text" name="location2"
                   placeholder="计算机与信息技术学院" value="{{ Auth::user()->location2 }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="email">邮箱</label>
                <div class="col-md-10">
                  <input id="email" class="input-sm form-control" type="text" name="email"
                   value="{{ Auth::user()->email }}" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-2 control-label" for="phone">手机</label>
                <div class="col-md-10">
                  <input id="phone" class="input-sm form-control" type="text" name="phone"
                   value="{{ Auth::user()->phone }}" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                  <button class="btn btn-sm btn-primary" type="submit" name="button">@icon('send')报名</button>
                </div>
              </div>
            </form>
          @endif
        @else
          {{-- out of register time --}}
          不在注册时间
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
