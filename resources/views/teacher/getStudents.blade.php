<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle1">Student List</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body pt-4">
    <div class="col-sm-12">

        @if (count($students) > 0) 
            <table id="getstudentlist" class="table table-sm table-bordered display" data-page-length="100" data-order="[[0, &quot;asc&quot; ]]" style="width:100%" data-page-length="10" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            @php
            $i = 0;
            @endphp
            <tbody>
                @foreach ($students as $row)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->phone}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
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