
<table id="ticketlist" class="table table-sm table-bordered display" data-page-length="100" data-order="[[0, &quot;asc&quot; ]]" style="width:100%" data-page-length="10" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
    <thead>
        <tr class="text-center">
            <th>#</th>
            <th>Teacher Name</th>
            <th>Issue</th>
            <th>Status</th>
            <th>Comments</th>
            <th>Create Date</th>
        </tr>
    </thead>

    @if(count($helpTickets) > 0)
    @php
    $n = count($helpTickets);
    $n-=1;
    $i = 0;
    @endphp
    <tbody id="ticketlistBody">

        @foreach($helpTickets as $help)
        <tr id="help_id_{{ $help->id }}">
            <td>{{++$i}}</td>
            <td>
                @if($help->teacher)
                {{$help->teacher->name}} </br> ( <span style="font-weight:600;font-size:12px;color:#007bff">{{$help->teacher->phone}} </span>)
                @endif
            </td>
            <td class="text-center">
                <b>Category</b> :
                @if($help->help_ticket_category_id==null)
                @if($help->studentClass)
                {{($help->help_type == 2)?$help->studentClass->class_name:''}}

                {{($help->help_type == 2)?$help->studentClass->section_name:''}}
                @endif
                @if($help->studentSubject)
                {{($help->help_type == 2)?$help->studentSubject->subject_name:''}}
                @endif
                @endif
                @foreach($categories as $category)
                @if($category->id == $help->help_ticket_category_id)
                {{$category->category}}
                @endif
                @endforeach
                @if(isset($help->studentClass->class_name))
                ({{$help->studentClass->class_name}} {{$help->studentClass->section_name}})
                @endif
                <br>
                @if($help->description)
                <b>Description</b> :
                {{isset($help->description)?$help->description:''}}
                <br>
                @endif
                @if($help->class_join_link)
                <a href="javascript:void(0);" data-helplink="{{$help->class_join_link}}" class="delete-color" id="{{ $help->id}}">Join Live</a>
                @endif
            </td>
            <td style="width: 15%">
                <select name="status" class="form-control" data-selectStatus="{{ $help->id }}" {{($help->status == 3)?'disabled':''}}>
                    <option value="1" {{($help->status == 1)?'selected':''}}>
                        Pending
                    </option>
                    <option value="2" {{($help->status == 2)?'selected':''}}>In
                        Progress
                    </option>
                    <option value="3" {{($help->status == 3)?'selected':''}}>
                        Closed
                    </option>
                </select>
            </td>
            <td class="text-center comment">
                {{isset($help->comments)?$help->comments:''}}
            </td>
            <td>
                <span style="font-size:14px;">{{date("d/m/Y h:i a",strtotime($help->created_at))}} </span>
            </td>
        </tr>
        @endforeach
    </tbody>
    @endif
</table>


<script type="text/javascript">
    $(document).ready(function() {
         $('#ticketlist').DataTable({

            initComplete: function(settings, json) {
                $('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
                $('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))


                    // setTimeout(function() {
                    // location.reload(true);
                    // }, 3000);
            }
        });
        $('.dateset').datepicker({
            dateFormat: "yy/mm/dd"
            // showAnim: "slide"
        })

    });
</script>
