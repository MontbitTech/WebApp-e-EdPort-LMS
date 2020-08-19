@php
$s = \App\Http\Helpers\CustomHelper::getSchool();

foreach($s as $sch)
{
if($sch->item == "schoolname"){
$sname = $sch->value;
}
}
@endphp

@extends('layouts.app')
@section('content')
<section class="login-section">
  <div class="container-fluid min-height">
    <div class="row justify-content-center min-height align-items-center">
      <div class="col-sm-10 col-md-8 col-lg-5 offset-lg-7 col-xl-4">
        <div class="login-form">
          <div class="pb-3">
            <h1 class="pb-0 mb-0" style="color: #D1D6E5;">{{$sname}}</h1>
            <div class="text-center text-white pt-0">
              <small style="color: #D1D6E5;"> Powered by e-EdPort</small>
            </div>
          </div>
          <!-- <ul class="nav nav-pills mb-4 justify-content-center" role="tablist">
            <li class="nav-item">
              <a class="nav-link text-white border-0 btn-shadow active" data-toggle="pill" href="#teacherBox">
                <svg class="icon icon-3x mr-2 mmb-2"><use xlink:href="{{asset('images/icons.svg#icon_teacher')}}"></use></svg> Teacher
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white border-0 btn-shadow" data-toggle="pill" href="#supportBox">
                <svg class="icon icon-1x mr-2 mmb-1"><use xlink:href="{{asset('images/icons.svg#icon_support')}}"></use></svg> Support
              </a>
            </li>
          </ul> -->
          <div class="tab-content">
            <div class="tab-pane fade " id="teacherBox">
              <form method="POST" action="{{ route('teacher.login') }}">
                @csrf
                <div class="form-group">
                  <input id="login_pin" type="password" class="form-control form-control-lg" name="login_pin" placeholder="Enter PIN" required>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block">
                    {{ __('Login') }}
                </div>
              </form>
            </div>

            <div class="tab-pane fade show active" id="supportBox">
              <form method="POST" class="loginbox-section" action="{{ route('teacher.login.post') }}">
                @csrf
                <div class="form-group mb-4">
                  <button type="submit" class="btn btn-lg login-color  btn-block">
                    {{ __('I Am School Teacher') }}
                  </button>
                </div>

                <iframe id="logoutframe" src="https://accounts.google.com/logout" style="display: none"></iframe>
              </form>
              <!--   
              <form method="POST" class="loginbox-section" action="#">
              @csrf
                <div class="form-group mb-4">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                            {{ __('Student Login') }}
                        </button>
                </div>
              </form>
 -->
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection