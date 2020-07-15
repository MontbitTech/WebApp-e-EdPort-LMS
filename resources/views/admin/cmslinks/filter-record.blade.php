<div class="col-sm-12" id="cms">
          <table id="cmsrecords" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 2, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
              <tr>
                <th>#</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Topic</th>
                <th>Link</th>
                <th>Assignment Link</th>
				<th>Action</th>
              </tr>
            </thead>
            
          <tbody>
           @if($getResult)
              @php $i=0; @endphp
		  
		  
                @foreach($getResult as $list)
			
                  <tr>
                    <td>{{++$i}}</td>
                    <td class="text-center">{{$list->class}}</td>
                    <td>{{$list->getSubject->subject_name}}</td>
                    <td>{{$list->topic}}</td>
                    <td>
					@if(empty($list->link))
						 <?=""?>
					@else
						<a href='{{$list->link}}' target="_blank">Open Link</a>
					@endif
					</td>
					 <td>
					@if(empty($list->assignment_link))
						 <?=""?>
					@else
						<a href='{{$list->assignment_link}}' target="_blank">Open Assignment Link</a></td>
					@endif
					<td>
						<a href="{{route('cms.editlink', encrypt($list->id))}}">Edit</a> | 
						<a href="#"
						onclick="event.preventDefault();
						document.getElementById('delete-cms-form{{$list->id}}').submit();">
						{{ __('Delete') }}
						</a>

					  <form id="delete-cms-form{{$list->id}}" action="{{ route('cms.deletelink', encrypt($list->id)) }}" method="POST" style="display: none;">
						@csrf
					  </form>
                  </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>