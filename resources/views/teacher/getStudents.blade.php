<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle1">Student List</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

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
                    <td>
                        <input type="checkbox" id="attendance_{{$student->id}}" name="attendance[{{$student->id}}]" @if(count($student->attendance))
                        @if($student->attendance[0]->status)
                        checked
                        @endif
                        @endif

                        value='1'>

                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            @if(date('y-m-d') <= date('y-m-d',strtotime($dateClass->class_date)))
                <input type="submit" class="btn btn-primary px-4 mr-2 text-center" @if(count($student->attendance)) disabled @endif value="save">
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
</script>