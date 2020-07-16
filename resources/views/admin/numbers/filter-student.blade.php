 <div class="col-sm-12" id="student">
          <table id="studentlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
              <tr>
                @if($getResult)
               <th width="50px"><input type="checkbox" class="master"id="master"></th>
               @endif
                <th>#</th>
                <th>Name</th>
                <th>Class</th>
                <th>Section</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Notify</th>
        <th>Action</th>
              </tr>
            </thead>
            
          <tbody>
           @if($getResult)
           <button style="margin-bottom: 10px" class="btn btn-info delete_all" data-url="{{ url('admin/deleteAllStudent') }}">Delete All Selected</button>
              @php $i=0; @endphp
                @foreach($getResult as $list)
                  <tr id="tr_{{$list->id}}">
                     <td><input type="checkbox" class="sub_chk" data-id="{{$list->id}}"></td>
                    <td>{{++$i}}</td>
                    <td>{{$list->name}}</td>
                    <td>{{$list->class_name}}</td>
                    <td>{{$list->section_name}}</td>
                    <td>{{$list->email}}</td>
                    <td>{{$list->phone}}</td>
                    <td>
            @if ($list->notify=="yes")
              <input type="checkbox" checked disabled>
            @else
              <input type="checkbox"  disabled>
            @endif
          </td>
          <td>
            <a href="{{route('student.edit', encrypt($list->id))}}">Edit</a> | 
            <a href="#"
            onclick="event.preventDefault();
            document.getElementById('delete-student-form{{$list->id}}').submit();">
            {{ __('Delete') }}
            </a>

            <form id="delete-student-form{{$list->id}}" action="{{ route('student.delete',encrypt($list->id)) }}" method="POST" style="display: none;">
            @csrf
            </form>
                  </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>


   <script type="text/javascript">
    $(document).ready(function () {


$('#master').on('click', function(e) {
 if($(this).is(':checked',true))  
 {
    $(".sub_chk").prop('checked', true);  
 }
 else {  
    $(".sub_chk").prop('checked',false); 
 }  
});

$('.sub_chk').change(function(){ //".checkbox" change 
if($('.sub_chk:checked').length == $('.sub_chk').length){
 $('.master').prop('checked',true);
}
else{
$('.master').prop('checked',false);
         }
 });


$('.delete_all').on('click', function(e) {

    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
        allVals.push($(this).attr('data-id'));
    });  


    if(allVals.length <=0)  
    {  
        alert("Please select row.");  
    }  else {  


        var check = confirm("Are you sure you want to delete this row?");  
        if(check == true){  


            var join_selected_values = allVals.join(","); 


            $.ajax({
                url: $(this).data('url'),
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: 'ids='+join_selected_values,
                success: function (data) {
                    if (data['success']) {
                        $(".sub_chk:checked").each(function() {  
                            $(this).parents("tr").remove();
                             //location.reload(true);
                             $('.master').prop('checked',false);
                        });
                        //alert(data['success']);
                       $.fn.notifyMe('success', 7, "Deleted Successfully");
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            $.each(allVals, function( index, value ) {
                $('table tr').filter("[data-row-id='" + value + "']").remove();
            });
        }  
    }  
});

$(document).on('confirm', function (e) {
    var ele = e.target;
    e.preventDefault();


    $.ajax({
        url: ele.href,
        type: 'DELETE',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (data) {
            if (data['success']) {
                $("#" + data['tr']).slideUp("slow");
                alert(data['success']);
            } else if (data['error']) {
                alert(data['error']);
            } else {
                alert('Whoops Something went wrong!!');
            }
        },
        error: function (data) {
            alert(data.responseText);
        }
    });


    return false;
});
});
</script>