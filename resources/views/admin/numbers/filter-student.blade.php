 <div class="col-sm-12" id="student">
   <table id="studentlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
     <thead>
       <tr>
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
       @php $i=0; @endphp
       @foreach($getResult as $list)
       <tr>
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
           <input type="checkbox" disabled>
           @endif
         </td>
         <td>
           <a href="{{route('student.edit', encrypt($list->id))}}">Edit</a> |
           <a href="javascript:void(0);" data-deleteModal="{{$list->id}}">
             {{ __('Delete') }}
           </a>

           <!-- <form id="delete-student-form{{$list->id}}" action="{{ route('student.delete',encrypt($list->id)) }}" method="POST" style="display: none;">
             @csrf
           </form> -->
         </td>
       </tr>
       @endforeach
       @endif
     </tbody>
   </table>
 </div>