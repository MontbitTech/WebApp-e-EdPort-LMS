<div class="col-sm-12" id="getticket">
                                    <table id="ticketlist" class="table table-sm table-bordered display"
                                           data-page-length="100" data-order="[[0, &quot;desc&quot; ]]"
                                           style="width:100%" data-page-length="10" data-col1="60" data-collast="120"
                                           data-filterplaceholder="Search Records ...">
                                        <thead>
                                        <tr class="text-center">
                                            <th>SNO</th>
                                            <th>Teacher Name</th>
                                            <th>Class</th>
                                            <th>Subject</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Class Join link</th>
                                            <th>Create Date</th>
                                        </tr>
                                        </thead>

                                        @if(count($support_help) > 0)
                                            @php
                                                $n = count($support_help);
                                                $n-=1;
                                                $i = 0;
                                            @endphp
                                            <tbody>

                                            @foreach($support_help as $help)
                                                <tr>
                                                    <td>{{++$i}}</td>
                                                    <td>
                                                        @if($help->teacher)
                                                        {{$help->teacher->name}} </br> ( <span
                                                                style="font-weight:600;font-size:12px;color:#007bff">{{$help->teacher->phone}} </span>)
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($help->studentClass)
                                                            {{($help->help_type == 2)?$help->studentClass->class_name:''}}
                                                        @endif
                                                        @if($help->studentClass)
                                                            {{($help->help_type == 2)?$help->studentClass->section_name:''}}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @if($help->studentSubject)
                                                            {{($help->help_type == 2)?$help->studentSubject->subject_name:''}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach($categories as $category)
                                                            @if($category->id == $help->help_ticket_category_id)
                                                                {{$category->category}}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{isset($help->description)?$help->description:''}}</td>
                                                    <td style="width: 15%">
                                                        <select name="status" class="form-control"
                                                                data-selectStatus="{{ $help->id }}">
                                                            <option value="1" {{($help->status == 1)?'selected':''}} >
                                                                Pending
                                                            </option>
                                                            <option value="2" {{($help->status == 2)?'selected':''}} >In
                                                                Progress
                                                            </option>
                                                            <option value="3" {{($help->status == 3)?'selected':''}} >
                                                                Closed
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($help->class_join_link)
                                                            <a href="javascript:void(0);"
                                                               data-helplink="{{$help->class_join_link}}"
                                                               id="{{ $help->id}}">Join Live</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span style="font-size:14px;">{{date("d/m/Y h:i a",strtotime($help->created_at))}} </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        @endif
                                    </table>
                                </div>

<script type="text/javascript">
$(document).ready(function () {

var tbl = $('#ticketlist').DataTable({
initComplete: function (settings, json) {
$('[data-dtlist="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_length').find("label"));
$('[data-dtfilter="#' + settings.nTable.id + '"').html($('#' + settings.nTable.id + '_filter').find("input[type=search]").attr('placeholder', $('#' + settings.nTable.id).attr('data-filterplaceholder')))
}
});
$('.dateset').datepicker({
dateFormat: "yy/mm/dd"
// showAnim: "slide"
});

$('.ac-time').timepicker({
controlType: 'select',
oneLine    : true,
timeFormat : 'hh:mm tt'
});

});
</script>