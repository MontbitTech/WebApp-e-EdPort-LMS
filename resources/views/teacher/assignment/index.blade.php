@extends('layouts.teacher.app')
@section('content')



<?php //echo  count($class_list); 

?>
<script>
  $('.menu-open').removeClass();
</script>
<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-xl-8">
        <?php
        if (count($class_list) > 0) {
          $added_array = array();
          $i = 1;
          foreach ($class_list as $list) {

            $logged_teacher_id = $list->teacher_id;
            $added = $list->class_id . '_' . $list->subject_id;
            if (!in_array($added, $added_array)) {
              $added_array[] = $list->class_id . '_' . $list->subject_id;

              $cls = '';
              $class_name = '';
              $section_name = '';
              $g_class_id = '';
              $subject_name = '';
              if ($list->studentClass) {
                $cls = $list->studentClass->class_name;
                //$class_name = App\Http\Helpers\CommonHelper::addOrdinalNumberSuffix($cls);
                $section_name = $list->studentClass->section_name;
                $g_class_id = $list->studentClass->g_class_id;
              }
              if ($list->studentSubject) {
                $subject_name = $list->studentSubject->subject_name;
              }
        ?>
              <input type="hidden" id="dateClass_id{{$i}}" value="{{$list->id}}">
              <input type="hidden" id="txt_class_id{{$i}}" value="{{$list->class_id}}">
              <input type="hidden" id="txt_subject_id{{$i}}" value="{{$list->subject_id}}">
              <input type="hidden" id="txt_teacher_id{{$i}}" value="{{$list->teacher_id}}">


              <div class="classes-box px-3 min-height-auto" style="overflow:visible!important;">
                <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
                  <div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> {{ $cls }} Std</div>
                  <div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> {{$section_name}}</div>
                  <div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> {{$subject_name}}</div>
                </div>
                <hr class="mt-0 mb-1">
                <div class="d-flex justify-content-between flex-wrap py-2">
                  <div>

                    <input type="hidden" id="g_class_id_{{$i}}" value="{{ $g_class_id}}" />
                    <a href="javascript:void(0);" id="new_a_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow" data-createModal='{{$i}}' data-class_modal="{{$list->class_id}}" data-subject_modal="{{$list->subject_id}}" data-teacher_modal="{{$list->teacher_id}}">
                      <svg class="icon mr-1">
                        <use xlink:href="../images/icons.svg#icon_file"></use>
                      </svg> New Assignment
                    </a>
                    <!-- <ul class="dropdown-menu">data-toggle="dropdown"
                          <a class="dropdown-item" href="#">Profile</a>
                          <a class="dropdown-item" href="#">Change Password</a>
                      </ul> -->
                    <?php
                    $assignmentData = App\Http\Helpers\CommonHelper::get_exam_assignment_data($g_class_id);
                    ?>
                    @if (count($assignmentData) > 0)
                    <button onclick="viewAssignment('{{$g_class_id}}')" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow" data-toggle="modal" data-target="#exampleModalLong">View Assigment</button>
                    @else

                    <button class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow">No Assigment</button>

                    @endif

                  </div>

                  <!-- <input type="button" name="save" value="save" onclick="openDialog()" /> -->

                </div>
              </div>


          <?php
              $i++;
            }
          }
        } else {
          ?>
          <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
            <svg class="icon icon-4x mr-3">
              <use xlink:href="../images/icons.svg#icon_nodate"></use>
            </svg> No Record Found!
          </div>
        <?php } ?>
      </div>

      <div class="col-md-4 col-xl-4 mb-3">
        <div class="p-3 p-md-4 h-100 bg-lightblue">
          <h5 class="font-weight-bold mb-3">Standard Assignment</h5>
          <div class="form-group">
            <label for="classChoose" class="mb-0">Class:</label>
            <select class="form-control form-control-sm border-0" id="classChoose">
              <option>Select Class</option>
              @foreach($cmsclass as $key => $data)
              <option value="{{ $data->class }}">{{$data->class}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="subjectChoose" class="mb-0">Subject:</label>
            <select class="form-control form-control-sm border-0" id="subjectChoose">
              <option value="0">Select Subject</option>
            </select>
          </div>

          <div class="form-group">
            <label for="topicChoose" class="mb-0">Topic:</label>
            <select class="form-control form-control-sm border-0" id="topicChoose">
              <option>Select Topic</option>
            </select>
          </div>
          <ul class="pl-4" id='topiclinks'>


          </ul>
        </div>
      </div>
    </div>
  </div>
</section>




<!-- New Assignment Modal -->
<div class="modal fade" id="createAssiModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">New Assignment </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
        <div class="form-group row">
        </div>
        <input type="hidden" id="row_id" value="">
        <input type="hidden" id="new_assignment" value="">
        <input type="hidden" id="g_class_id" value="">
        <input type="hidden" id="ass_class_id" value="">
        <input type="hidden" id="ass_subject_id" value="">
        <input type="hidden" id="ass_teacher_id" value="">
        <div class="row">
          <div class="form-group col-md-5">
            <input checked type="radio" id="t1radio" name="asgradio">
            <label for="t1radio" class="col-form-label text-md-left">Select Topic :</label>
            <div>
              <select name="sel_topic" id="sel_topic" class="form-control asg1">
                <option value="">Select Topic</option>
              </select>
            </div>
          </div>
          <div class="col-md-2 text-center">
            OR
          </div>
          <div class="form-group col-md-5">
            <input type="radio" id="t2radio" name="asgradio">
            <label for="t2radio" class="col-form-label text-md-left">Enter New Topic
              :</label>
            <div>
              <input disabled type="text" id="txt_topin_name" class="form-control asg2" placeholder="Topic Name" />
            </div>
          </div>
          <div class="form-group col-md-12">
            <label for="txt_aTitle" class="col-form-label text-md-left"> Assignment Title:</label>
            <div>
              <input type="text" class="form-control" name="txt_aTitle" id="txt_aTitle" placeholder="Assigment Title">
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="txt_aTitle" class="col-form-label text-md-left"> Due Date:</label>
            <div>
              <input type="date" class="form-control" name="txt_due_date" id="txt_due_date" placeholder="Due Date">
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="txt_aTitle" class="col-form-label text-md-left"> Due Time:</label>
            <div>
              <input type="text" class="form-control due-time" name="txt_due_time" id="txt_due_time" placeholder="Due Time">
            </div>
          </div>

          <div class="form-group col-md-4">
            <label for="txt_aTitle" class="col-form-label text-md-left"> Point:</label>
            <div>
              <input type="number" class="form-control" name="txt_point" id="txt_point" placeholder="Point">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12" style="text-align: center;">
            <button type="button" id="assignment_create" class="btn btn-primary px-4">Create</button>
            <button type="button" id="attach_file" class="btn btn-primary px-4">Create and Attach File</button>
            <button type="button" id="cancel_assignment" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
        <p style="font-size: smaller;color: red;text-align: center;">Note: Please allow popup for the assignment functionality.</p>
      </div>
    </div>
  </div>
</div>
<!-- ./New Assignment Modal -->
<!-- ./New Assignment Modal -->
<div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">View Assignment </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">


        <table id="assignmentList" class="table table-hover btn-shadow table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
          <thead class="text-white" style="background:#253372;">
            <tr>

              <th>Assignment Name</th>
              <th>Link</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>



      </div>
    </div>
  </div>
</div>
<!-- ./View Assignment Modal -->
<!-- Open Live link in modal  -->
<div class="modal fade" id="viewClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">View Assigment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
        <iframe id="thedialog" width="100%" height="100%"></iframe>
      </div>
    </div>
  </div>
</div>


<!-- Edit Class Modal 
<div class="modal fade" id="editClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title font-weight-bold">Edit Assignment Links</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-4">
          <input type="text"  id="edit_assignment" value="">
          <div class="form-group row">
            <label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">New Assigment URL <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" name="new_assignment_url" id="new_assignment_url" rows="3" placeholder="Enter Link" required=""></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputAddquiz" class="col-md-4 col-form-label text-md-right">Given Assignment URL <small>(Link)</small>:</label>
            <div class="col-md-6">
              <textarea class="form-control" name="old_assignment_url" id="old_assignment_url" rows="3" placeholder="Enter Link"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" id="assignment_edit" class="btn btn-primary px-4">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>-->

<script type="text/javascript">
  $(document).on('click', '[data-oldlink]', function() {
    var liveurl = $(this).attr("data-oldlink");
    if (liveurl != '') {
      //$('#viewClassModal').modal('show');
      //$("#thedialog").attr('src','https://google.com');
      window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
    } else {
      alert('No assignement url found!');
    }
  });

  $(document).on('click', '[data-editlink]', function() {
    var liveurl = $(this).attr("data-editlink");
    if (liveurl != '') {
      window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
    } else {
      alert('No assignement url found!');
    }
  });


  /* 

  $(document).on('click', '[data-editmodal]', function(){
   var editmodal = $(this).data('editmodal');
    $('#edit_assignment').val(editmodal);
    $('#new_assignment_url').val($('#new_a_link_'+editmodal).attr('href'));
    $('#old_assignment_url').val($('#old_a_link_'+editmodal).attr('href'));
    $('#editClassModal').modal('show');
  }); */


  $(document).on('click', '[data-createModal]', function() {
    var id = $(this).data('createmodal');
    $('#new_assignment').val($("#dateClass_id" + id).val());
    $("#row_id").val(id);
    $('#g_class_id').val($('#g_class_id_' + id).val());
    $("#ass_class_id").val($('#txt_class_id' + id).val());
    $("#ass_subject_id").val($('#txt_subject_id' + id).val());
    $("#ass_teacher_id").val($('#txt_teacher_id' + id).val());

    var class_id = $('[data-createmodal="' + id + '"]').data('class_modal');
    var subject_id = $('[data-createmodal="' + id + '"]').data('subject_modal');
    //var teacher_id = $('[data-createmodal="'+id+'"]').data('teacher_modal');


    /* console.log(id);
	 console.log(class_id);
	console.log(subject_id); 
	exit; */
    $("#txt_aTitle").val('');
    $("#txt_topin_name").val('');
    $('#createAssiModal').modal('show');

    $.ajax({
      url: "{{url('get-assignment')}}",
      type: "POST",
      data: {
        class_id: class_id,
        subject_id: subject_id
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {
        var response = JSON.parse(result);
        if (response.status == 'success') {

          var AssigmentData = response.data;
          var topics = response.topics;
          var data = '';
          var topicData = '<option value="">Select Topic</option>';
          AssigmentData.forEach(function(val) {

            data += '<li> <a href="javascript:void(0);" onclick="give_assignment(\'' + id + '\',\'' + val.g_live_link + '\',\'' + val.id + '\',\'' + val.g_title + '\')" >' + val.g_title + '</a>';
            data += ' ( <a  href="javascript:void(0);" data-viewAssignment="' + val.g_live_link + '" > View </a>) </li>';

          });

          topics.forEach(function(val) {

            topicData += '<option value="' + val.id + '">' + val.topicname + '</option>';


          });


          $("#sel_topic").html('');
          $("#sel_topic").append(topicData);
          $("#li_assignment").html('');
          $("#li_assignment").append(data);

        } else {
          $.fn.notifyMe('error', 5, response.message);
        }
      }
    });
  });


  $(document).on('click', '#assignment_create', (function() {
    $('#assignment_create').prop('disabled', true);
    $('#attach_file').prop('disabled', true);
    $('#cancel_assignment').prop('disabled', true);
    var id = $("#row_id").val();
    var class_id = $('#ass_class_id').val();
    var subject_id = $('#ass_subject_id').val();
    var teacher_id = $('#ass_teacher_id').val();
    //var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
    var g_class_id = $('#g_class_id').val();

    var txt_topic_name = $('#txt_topin_name').val();
    var sel_topic_name = $('#sel_topic').val();
    var assignment_title = $('#txt_aTitle').val();
    var dueDate = $('#txt_due_date').val();
    var dueTime = $('#txt_due_time').val();
    var point = $('#txt_point').val();
    var dateClass_id = ''; //$('#new_assignment').val();

    $.ajax({
      url: "{{url('create-assignment')}}",
      type: "POST",
      data: {
        g_class_id: g_class_id,
        txt_topic_name: txt_topic_name,
        sel_topic_name: sel_topic_name,
        assignment_title: assignment_title,
        dueDate: dueDate,
        dueTime: dueTime,
        point: point,
        class_id: class_id,
        subject_id: subject_id,
        teacher_id: teacher_id,
        dateClass_id: dateClass_id
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {
        var response = JSON.parse(result);
        if (response.status == 'success') {
          $.fn.notifyMe('success', 5, response.message);
          $('#createAssiModal').modal('hide');
          var data = '<option value="' + response.cource_url + '">' + assignment_title + '</option>';
          $('#view_a_link_' + id).append(data);
          $('#assignment_create').prop('disabled', false);
          $('#attach_file').prop('disabled', false);
          $('#cancel_assignment').prop('disabled', false);
        } else {
          $.fn.notifyMe('error', 5, response.message);
          $('#assignment_create').prop('disabled', false);
          $('#attach_file').prop('disabled', false);
          $('#cancel_assignment').prop('disabled', false);
        }
      }
    });
  }));

  $(document).on('click', '#attach_file', (function() {
    $('#assignment_create').prop('disabled', true);
    $('#attach_file').prop('disabled', true);
    $('#cancel_assignment').prop('disabled', true);
    var id = $("#row_id").val();
    var class_id = $('#ass_class_id').val();
    var subject_id = $('#ass_subject_id').val();
    var teacher_id = $('#ass_teacher_id').val();
    //var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
    var g_class_id = $('#g_class_id').val();
    var txt_topic_name = $('#txt_topin_name').val();
    var sel_topic_name = $('#sel_topic').val();
    var assignment_title = $('#txt_aTitle').val();
    var dueDate = $('#txt_due_date').val();
    var dueTime = $('#txt_due_time').val();
    var point = $('#txt_point').val();
    var dateClass_id = ''; //$('#new_assignment').val();

    $.ajax({
      url: "{{url('create-assignment')}}",
      type: "POST",
      data: {
        g_class_id: g_class_id,
        txt_topic_name: txt_topic_name,
        sel_topic_name: sel_topic_name,
        assignment_title: assignment_title,
        class_id: class_id,
        subject_id: subject_id,
        teacher_id: teacher_id,
        dateClass_id: dateClass_id,
        dueDate: dueDate,
        dueTime: dueTime,
        point: point

      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {
        var response = JSON.parse(result);
        if (response.status == 'success') {
          $.fn.notifyMe('success', 5, response.message);
          $('#createAssiModal').modal('hide');
          window.open(response.cource_url, "title", "dialogWidth:400px;dialogHeight:300px");
          var data = '<option value="' + response.cource_url + '">' + assignment_title + '</option>';
          $('#view_a_link_' + id).append(data);
          $('#assignment_create').prop('disabled', false);
          $('#attach_file').prop('disabled', false);
          $('#cancel_assignment').prop('disabled', false);
        } else {
          $.fn.notifyMe('error', 5, response.message);
          $('#assignment_create').prop('disabled', false);
          $('#attach_file').prop('disabled', false);
          $('#cancel_assignment').prop('disabled', false);
        }
      }
    });
  }));


  $("#classChoose").change(function() {
    var id = $(this).val();

    $.ajax({
      url: "{{url('get-subjects')}}",
      type: "POST",
      data: {
        class_id: id
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {
        var response = JSON.parse(result);
        if (response.status == 'success') {
          $("#subjectChoose").empty();
          $("#subjectChoose").append('<option value="">Select Subject</option>');

          response.data.forEach(function(arrayItem) {
            $("#subjectChoose").append('<option value="' + arrayItem["id"] + '">' + arrayItem["name"] + '</option>');
          });

          $("#subjectChoose").focus();
        }
      }
    });
  });

  $("#subjectChoose").change(function() {
    var id = $(this).val();
    var clsid = $("#classChoose").val();

    $.ajax({
      url: "{{url('get-topics')}}",
      type: "POST",
      data: {
        class_id: clsid,
        subject_id: id
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {
        var response = JSON.parse(result);
        if (response.status == 'success') {
          $("#topicChoose").empty();
          $("#topicChoose").append('<option value="">Select Topic</option>');

          response.data.forEach(function(arrayItem) {

            $("#topicChoose").append('<option value="' + arrayItem["id"] + '">' + arrayItem["name"] + '</option>');

          });

          $("#topicChoose").focus();
        }
      }
    });
  });

  $("#topicChoose").change(function() {
    var clsid = $("#classChoose").val();
    var subid = $("#subjectChoose").val();
    var topicid = $(this).val();
    $("#topiclinks").empty();
    $.ajax({
      url: "{{url('get-links')}}",
      type: "POST",
      data: {
        class_id: clsid,
        subject_id: subid,
        topic_id: topicid
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {
        var response = JSON.parse(result);
        if (response.status == 'success') {


          response.data.forEach(function(arrayItem) {
            if (arrayItem['name'] != "" && arrayItem['name'] != null && arrayItem != 'undedined') {
              $("#topiclinks").append('<li><a target="_blank" href="' + arrayItem["name"] + '">' + arrayItem["name"] + '</a></li>');
            } else {
              $("#topiclinks").append('<li> No Assigment </li>');
            }
          });
        }
      }
    });
  });


  function give_assignment(id, link, classwork_id, title) {
    ///console.log(id);
    //console.log(link);
    var dateClass_id = $('#new_assignment').val();
    //var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
    //var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
    $.ajax({
      url: "{{url('give-assignment')}}",
      type: "POST",
      data: {
        dateClass_id: dateClass_id,
        classwork_id: classwork_id
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(result) {

        ///  console.log(result);
        var response = JSON.parse(result);


        if (response.status == 'success') {
          //$('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
          var data = '<option value="' + link + '">' + title + '</option>';
          $('#view_a_link_' + id).append(data);
          $.fn.notifyMe('success', 5, response.message);
          $('#createAssiModal').modal('hide');

        } else {
          $.fn.notifyMe('error', 5, response.message);
        }
      }
    });


  }
  $(document).on('click', '[data-viewAssignment]', function() {
    var liveurl = $(this).attr("data-viewAssignment");
    if (liveurl != '') {
      //$('#viewClassModal').modal('show');
      //$("#thedialog").attr('src','https://google.com');
      window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
    } else {
      alert('No assignement url found!');
    }
  });


  /* 
  $(document).on('click', '#assignment_edit',(function(){
   var edit_assignment = $('#edit_assignment').val();
  var class_modal = $('[data-editmodal="'+edit_assignment+'"]').data('class_modal');
  var subject_modal = $('[data-editmodal="'+edit_assignment+'"]').data('subject_modal');
  var new_assignment_url = $('#new_assignment_url').val();
  var old_assignment_url = $('#old_assignment_url').val();

   $.ajax({
        url: "{{url('edit-assignment')}}",
        type: "POST",
        data: {class:class_modal,subject:subject_modal,new_assignment_url:new_assignment_url,old_assignment_url:old_assignment_url},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(result){                          
            var response = JSON.parse(result);
            if(response.status == 'success'){
                $('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
                $('#old_a_link_'+edit_assignment).attr('href',old_assignment_url);
                $.fn.notifyMe('success', 5, response.message);
                $('#editClassModal').modal('hide');
            }else{
                $.fn.notifyMe('error', 5, response.message);
            }
        }             
    });
  })); */

  /* 
  function openDialog()
  {
  	 window.open("https://classroom.google.com/c/OTcwNTI1MzUwOTFa/a/MTAwMTUzNjkwNjQ4/details","dialog name",
           "dialogWidth:400px;dialogHeight:300px");
  } */
</script>
<script>
  $(document).ready(function() {
    $('input[id=t1radio]').on('click',
      function() {
        $('.asg1').prop("disabled", false);
        $('.asg2').prop("disabled", true);
        $('.asg2').prop("value", "");
      });
    $('input[id=t2radio]').on('click',
      function() {
        $('.asg2').prop("disabled", false);
        $('.asg1').prop("disabled", true);
        $('.asg1').prop("value", "");
      });
  });
</script>
<script>
  $(document).on('click', '[data-viewAssignment]', function() {
    var liveurl = $(this).attr("data-viewAssignment");
    if (liveurl != '') {
      //$('#viewClassModal').modal('show');
      //$("#thedialog").attr('src','https://google.com');
      window.open(liveurl, "dialog name", "dialogWidth:400px;dialogHeight:300px");
    } else {
      alert('No assignement url found!');
    }
  });

  function viewAssignment(id) {

    $.ajax({
      type: 'POST',
      url: '{{ url("/teacher/class/examassignments") }}',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        'class_id': id,
      },
      success: function(result) {
        var response = JSON.parse(result);
        let data = '';
        response.data.forEach(function(classAssignment) {
          $('#assignmentList').find('tbody').find('tr').remove();
          data += '<tr>';
          data += '<td>' + classAssignment.g_title + '</td>';
          data += '<td><a href="' + classAssignment.g_live_link + '" class="text-decoration-none" target="_blank">Link</a></td>';
          data += '</tr>';

          $('#assignmentList').find('tbody').append(data);
        });
      },
      error: function() {
        $.fn.notifyMe('error', 4, 'There is some error while searching for assignment!');
      }
    });
  }
</script>

<script>
  $(document).ready(function() {
    $('.due-time').timepicker({
      controlType: 'select',
      oneLine: true,
      timeFormat: 'hh:mm tt'
    });
  });
</script>
@endsection