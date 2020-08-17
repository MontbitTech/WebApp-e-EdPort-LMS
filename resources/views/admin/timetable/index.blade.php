@extends('layouts.admin.app')

@section('content')

@php

$class=$ar["class"];
$section=$ar["sname"];
$tname=$ar["tname"];
$subn=$ar["subname"];
$timing=$ar["timing"];

@endphp
<section class="main-section">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <a href="{{ route('reload-timetable') }}" target="_self">
                    Reload today's timetable for
                    all teachers
                </a>
                <div class="card card-common mb-3">
                    <div class="card-header">
                        <span class="topic-heading">Time Table</span>
                        <div class="float-right">
                            <a type="button" class="btn btn-sm btn-secondary" href="{{ route('admin.timetableimport') }}">
                                <i class="fas fa-file-import icon-4x mr-1"></i>
                                Import Time Table
                            </a>
                        </div>
                        <div class="float-right  mr-3">
                            <a type="button" class="btn btn-sm btn-secondary" href="{{ route('add.extracalss') }}">
                                <i class="fas fa-calendar-alt mr-1" aria-hidden="true"></i>
                                Add Extra Lecture
                            </a>
                        </div>
                        <!-- <div class="float-right mr-3">
              <a type="button" class="btn btn-sm btn-success" href="{{ route('admin.sampleDownload') }}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{ asset('images/icons.svg#icon_adduser') }}"></use></svg> Download Sample File
              </a>
            </div> -->
                    </div>
                    <div class="card-body pt-3">
                        <div class="row justify-content-center">

                            <div class="col-md-12 col-lg-12 text-center mb-1">

                                <form method="post" action="{{route('timetable-deleteAll')}}">
                                    @csrf
                                    <button type="submit" id="submit" style="float:right;display:none;" class="btn btn-secondary btn-sm" onclick="return confirmDelete()"><i class="fa fa-trash mr-1 " aria-hidden="true"></i>Delete
                                    </button>
                                    <span data-dtlist="#teacher" style="float:right;" class="mr-2">
                                        <!--  <div class="spinner-border spinner-border-sm text-secondary" role="status"></div> -->
                                        <a href='' class="btn btn-secondary btn-sm" target='_blank' id='download' style='display:none;'><i class="fa fa-download mr-1 " aria-hidden="true"></i>Download/View</a>
                                    </span>

                                    <span data-dtfilter="" class="mr-3" style="float:left;">


                                        <select id="txtSerachByClass" name="txtSerachByClass" class="form-control form-control-sm" onchange="getData()">
                                            <option value=''>Select Class</option>
                                            @if(count($class)>0)
                                            @foreach($class as $cl)
                                            <option value='{{ $cl->class_name }}'>{{ $cl->class_name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>

                                    </span>

                                    <span data-dtfilter="" style="float:left;">
                                        <!-- <div class="spinner-border spinner-border-sm text-secondary" role="status" ></div> 
                                        <input type="text"  id="txtSerachBySection" class="form-control form-control-sm" placeholder="Search By Section..." />-->

                                        <select id="txtSerachBySection" name="txtSerachBySection" class="form-control form-control-sm" onchange="getData()">
                                            <option value=''>Select Section</option>
                                            @if(count($section)>0)
                                            @foreach($section as $sl)
                                            <option value='{{ $sl->section_name }}'>
                                                {{ $sl->section_name }}
                                            </option>
                                            @endforeach
                                            @endif
                                        </select>

                                    </span>




                                </form>
                            </div>
                            <div class="col-sm-12" id='timetable'>
                                <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
                                    <thead>

                                        <tr>
                                            <th id='classname'></th>
                                            <th>Time</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    <div class="classes-box min-height-auto py-6 p-6 text-secondary text-center" id="no-timetable" style="display:none">
                    <svg class="icon icon-4x mr-3" >
                        <use xlink:href="../images/icons.svg#icon_nodate"></use>
                    </svg>
                    No time table available for the selected class
                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="classdeletModal" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light d-flex align-items-center">
                <h5 class="modal-title font-weight-bold">Update Timetable</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon">
                        <use xlink:href="{{ asset('images') }}/icons.svg#icon_times2"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body pt-6">

                <form action="{{ route('timetable.edit') }}" method="POST">
                    @csrf

                    <input type="hidden" name="tid" id="tid" />
                    <div class="form-group text-center">
                        <label class="text-danger">*Note : This is permanent change in Timetable</label>
                        <table class='table text-left'>
                            <tr>
                                <th>Teacher</th>
                                <td><label id='tname'></label></td>
                                <td><input type="radio" name="radio" id="tradio" value="tch" checked /></td>
                                <td>
                                    <select id="sel_teacher" name="sel_teacher" class="form-control form-control-sm" required>
                                        <option value=''>Select Teacher</option>
                                        @if(count($tname)>0)
                                        @foreach($tname as $tn)
                                        <option value='{{ $tn->id }}'>{{ $tn->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Subject</th>
                                <td><label id='subject_name'></label></td>
                                <td><input type="radio" name="radio" id="sradio" value="sub" /></td>
                                <td>
                                    <select id="sel_subject" name="sel_subject" class="form-control form-control-sm" disabled required>
                                        <option value=''>Select Subject</option>
                                        @if(count($subn)>0)
                                        @foreach($subn as $sn)
                                        <option value='{{ $sn->id }}'>{{ $sn->subject_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </td>
                            </tr>
                            <!--        <tr><td>          <input type="radio" name="temp" id="temp"> Temporary allocation</td>
                            <td colspan=2><input type="radio" name="temp" id="perm"> Permanent allocation</td>-->
                            </tr>
                        </table>


                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-danger px-4">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function editTimetable(id, day) {
        //var myday = Object.keys(day)[0];
        //var f = day.details.split('/');
        //alert(day.details);


    }

    $("input[type='radio']").on("click", function() {
        var option = this.value;
        if (option == "sub") {
            $("#sel_subject").attr('disabled', false);
            $("#sel_teacher").attr('disabled', true);
        } else {
            $("#sel_subject").attr('disabled', true);
            $("#sel_teacher").attr('disabled', false);
        }


    });

    $(document).on('click', '[data-deleteModal]', function() {
        var tid = $(this).data('id');
        var tname = $(this).data('tname');
        var sname = $(this).data('subject_name');
        var tn = document.getElementById('tname');
        var sn = document.getElementById('subject_name');
        var td = document.getElementById('tid');
        var timings = $(this).data('timing');
        var day = $(this).data('class_day');
        var classSection = $(this).data('')

        td.value = tid;
        tn.innerHTML = tname;
        sn.innerHTML = sname;

        $.ajax({
            type: 'POST',
            url: '{{ url("available/teacher") }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'timings': timings,
                'day': day,
                timeTableId: tid
            },
            success: function(result) {
                // var response = JSON.parse(result);
                console.log(result);
                if (result.status == 'success') {
                    setTeacherData(result.data.teacher);
                    setSubjectData(result.data.subject);
                } else {
                    $.fn.notifyMe('error', 5, 'something went wrong');
                }
            },
            error: function() {
                $.fn.notifyMe('error', 4, 'There is some error while searching for available class!');
            }
        });

        $('#classdeletModal').modal('show');
    });

    function getData() {
        var cl = document.getElementById("txtSerachByClass");
        var sl = document.getElementById("txtSerachBySection");
        var dl = document.getElementById("download");
        var tt = document.getElementById("timetable");
        var del = document.getElementById("submit");
        var norecord = document.getElementById("no-timetable");
        var url = "{{ route('list.filtertimetable') }}";

        if (cl.value == "") {
            cl.focus();
            return false;
        } else if (sl.value == "") {
            sl.focus();
            return false;
        } else {
            $.ajax({

                url: url,
                type: "POST",
                data: {
                    txtclass: cl.value,
                    txtsubject: sl.value
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                /* contentType: false,
                cache: false,
                processData:false, */
                success: function(data) {
                    dl.style.display  = "none";
                    del.style.display = "none";
                    norecord.style.display = "block";
                    tt.innerHTML = data["html"];
                    if (data["data"]) {
                        dl.href = "{{ url('/dl-timetable') }}" + "/" + cl.value + "_" + sl
                            .value + "_timetable.pdf";
                        dl.style.display = "block";
                        del.style.display = "block";
                        norecord.style.display = "none";
                    }
                }

            });
        }
    }

    function setTeacherData(teachers) {
        $("#sel_teacher option").remove();
        var data = "<option value=''> Select Teacher</option>";
        // console.log(response);
        teachers.forEach(function(teacher) {
            data += "<option value='" + teacher.id + "'>" + teacher.name + "</option>";
        })
        $("#sel_teacher").append(data);
    }

    function setSubjectData(subjects) {
        $("#sel_subject option").remove();
        var data = "<option value=''> Select Subject</option>";
        // console.log(response);
        subjects.forEach(function(subject) {
            data += "<option value='" + subject.id + "'>" + subject.subject_name + "</option>";
        })
        $("#sel_subject").append(data);
    }
</script>

<script type='text/javascript'>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click', '#delete-timetable', function() {
            var post_id = $(this).data("id");
            //alert(post_id);
            if (confirm("Are you sure want to delete this?")) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('timetable/delete')}}" + '/' + post_id,
                    success: function(data) {
                        //$("#student_id_" + post_id).remove();
                        location.reload(true);
                        $.fn.notifyMe('success', 10, "Deleted Successfully");
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });
</script>


<script>
    function confirmDelete() {
        return confirm('Are you sure want to delete this all?');
    }
</script>

@endsection