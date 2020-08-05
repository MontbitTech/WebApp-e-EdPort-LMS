@php

$sname = '';
$slogo = '';
$saddr = '';

$s = \App\Http\Helpers\CustomHelper::getSchool();

foreach($s as $sch)
{
if($sch->item == "schoolname")
$sname = $sch->value;
elseif($sch->item == "schoollogo")
$slogo = $sch->value;
elseif($sch->item == "schooladdress")
$saddr = $sch->value;
}

$logged_teacher = Session::get('teacher_session');
$logged_teacher_name = $logged_teacher['teacher_name'];
$logged_teacher_id = $logged_teacher['teacher_id'];
$photo = asset('images/teacher-profile.jpg');
$teacherData = App\Teacher::select('photo')->where('id',$logged_teacher_id)->get();
@endphp
@foreach($teacherData as $val)
@if($val->photo)
@php
$photo = asset('images/teacher/'.$val->photo);
@endphp
@endif
@endforeach


<!-- Start | Left Profile Section -->
<div class="profile-box">
  <div class="close-profile" title="Close">
    <svg class="icon">
      <use xlink:href="../images/icons.svg#icon_times2"></use>
    </svg>
  </div>

  <form method="post" id="profile_form" action="{{route('teacher.profile_picture')}}" enctype="multipart/form-data">
    @csrf
    <label class="profile-picture">
      <input type="file" name="profile_picture" id="uploadphoto" onchange="readURL(this);" accept=".jpg,.jpeg,.png,.gif">
      <span><svg class="icon">
          <use xlink:href="{{asset('images/icons.svg#icon_pen')}}"></use>
        </svg></span>
      <img src="{{ $photo }}" id="img-preview">
    </label>
  </form>

  <label class="profile-name">
    <input type="text" name="name" id="profile_name" onchange="updateName(this);" value="{{ strtoupper($logged_teacher_name) }}" placeholder="Enter Name" readonly>
  </label>
  <h4>Subject:</h4>

  @php


  $teachersData = App\ClassTiming::with('studentClass','studentSubject')->where('teacher_id',$logged_teacher_id)->get();
  $arr_subject = $arr_section = array();
  @endphp
  <ul>

    @foreach($teachersData as $key => $data)
    @php
    $arr_subject[] = isset($data->studentSubject)? $data->studentSubject->subject_name:'-';
    @endphp
    @endforeach
    @php
    $arr_subject = array_unique($arr_subject);
    @endphp
    @foreach($arr_subject as $value)
    <li>{{ isset($value)? $value : '-' }}</li>
    @endforeach
  </ul>
  <h4>Sections:</h4>
  <ul>
    @foreach($teachersData as $key => $data)
    @php
    $arr_section[] = isset($data->studentClass)?'Class '.$data->studentClass->class_name.' - '.$data->studentClass->section_name : '-';
    @endphp
    @endforeach
    @php
    $arr_section = array_unique($arr_section);
    @endphp
    @foreach($arr_section as $value)
    <li>{{ isset($value)?$value : '-'}}

    </li>
    @endforeach

  </ul>
  <h4>School:</h4>
  <div class="profile-school">
    <img src="{{$slogo}}">
    <h5 class="m-0 text-white">{{$sname}}</h5>


  </div>

  <div class="text-center text-white w-100 " style="position:absolute;bottom:0;font-size: 10px;letter-spacing: 1px;">
    <img src="{{asset('images/logo-1.png')}}" alt="e-edport" width="27px">
    <div>Powered by e-EdPort</div>

  </div>



</div>


<div class="fullbody-cover"></div>
<!-- End -->
<script type="text/javascript">
  /*Photo change of teacher*/
  function readURL(input) {

    $('#profile_form').submit();
    // if (input.files && input.files[0]) {
    //   var reader = new FileReader();
    //   reader.onload = function (e) {
    //     $('#img-preview').attr('src', e.target.result);
    //   };
    //   reader.readAsDataURL(input.files[0]);
    // }
  }

  function updateName(input) {
    var name = $('#profile_name').val();
    if (!name || name == '') {
      $.fn.notifyMe('error', 5, 'Please enter name.');
      return false;
    }
    /*Ajax Request Header setup*/
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: "{{ route('teacher.name')}}",
      method: 'post',
      data: {
        name: name
      },
      success: function(response) {
        $('.loader').fadeOut();
        //------------------------
        var result = JSON.parse(response);
        if (result.status == 'success') {
          $.fn.notifyMe('success', 5, result.message);
        } else if (result.status == 'error') {
          $.fn.notifyMe('error', 5, result.message);
        }
        //--------------------------
      },
      error: function() {
        $.fn.notifyMe('danger', 5, 'Something went wrong. Please try again');
      },
      complete: function() {}
    });
  }
</script>