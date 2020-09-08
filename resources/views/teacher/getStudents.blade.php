<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle1">Student List</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 2px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #373c8e;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #373c8e;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 24px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<div class="modal-body pt-4">
    <div class="col-sm-12">

        @if (count($students) > 0)
        {!! Form::open(array('route' => ['save.attendance'],'method'=>'POST','autocomplete'=>'off','id'=>'save_attendance')) !!}
        <input type="hidden" name="dateclass_id" id="dateclass_id" value="{{$dateClass->id}}">
        <table id="getstudentlist" class="table table-sm table-bordered display" data-page-length="100" data-order="[[0, &quot;asc&quot; ]]" style="width:100%" data-page-length="10" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            @php
            $i = 0;
            @endphp
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->phone}}</td>
                    <input type="hidden" name="attendance[{{$student->id}}]" value="0">
                    <td class="text-center">
                        <label class="switch"><input type="checkbox" id="attendance_{{$student->id}}" data-studentId="{{$student->id}}" name="attendance[{{$student->id}}]" 
                            @if(count($student->attendance))
                                @if($student->attendance[0]->status)
                                    checked
                                @endif
                            @else
                                checked
                            @endif
                            @if(date('y-m-d') > date('y-m-d',strtotime($dateClass->class_date)))
                                class="attendance"
                            @endif
                            value='1'><span class="slider round"></span></label>

                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            @if(date('y-m-d') <= date('y-m-d',strtotime($dateClass->class_date)))
                <input type="submit" class="btn btn-primary px-4 mr-2 text-center" value="save">
            @endif
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </form>
        @else

        <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
            <svg class="icon icon-4x mr-3">
                <use xlink:href="../images/icons.svg#icon_nodate"></use>
            </svg>
            No Record Found!
        </div>

        @endif
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#getstudentlist').DataTable({
            initComplete: function(settings, json) {
                $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
                $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
            }
        });
    });

    $('.attendance').on('click',function(){
        $('.loader').show();
        var dateclass_id = $('#dateclass_id').val();
        var student_id = $(this).attr('data-studentId');
        var status = 0;
        if($(this).prop('checked'))
            status = 1;
            
        $.ajax({
            url: '{{ url("/teacher/updateAttendance") }}',
            type: "POST",
            data: {
                student_id : student_id,
                dateclass_id: dateclass_id,
                status : status
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
                var response = JSON.parse(result);
                $('.loader').fadeOut();
                if(response.status == "success")
                    $.fn.notifyMe('success', 4, response.message);
                else
                    $.fn.notifyMe('error', 4, response.message);
            },
            error: function(result) {
                $('.loader').fadeOut();
                $.fn.notifyMe('error', 4, 'Something went wrong');
            }
        });
    });
</script>