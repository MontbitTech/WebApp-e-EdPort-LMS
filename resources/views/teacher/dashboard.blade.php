@extends('layouts.teacher.app')
@php $i = 1;$k=$i;@endphp
@section('content')

<?php 
$cls = 0;


?>

<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <ul class="nav nav-tabs1 nav-pills" id="myTab" role="tablist">
          <li class="nav-item mb-1">
            <a class="nav-link shadow-sm active" data-toggle="tab" href="#ulclasses" role="tab" aria-selected="true">Today's Live Classes</a>
          </li>
          <li class="nav-item mb-1">
            <a class="nav-link shadow-sm" data-toggle="tab" href="#plclasses" role="tab">Past Live Classes</a>
          </li>
		  <li class="nav-item mb-1">
            <a class="nav-link shadow-sm" data-toggle="tab" href="#newInvitationclasses" role="tab">Assigned Class</a>
          </li>
          <li class="nav-item mb-1 ml-md-auto">
            <a class="nav-link shadow-sm mr-0" data-toggle="modal" href="#addClassModal" role="modal">
              <svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add Classes
            </a>
          </li>
        </ul>
       <div class="tab-content pt-3">
          <div class="tab-pane fade show active" id="ulclasses">
		  
		  @if(count($TodayLiveData) > 0)
				
					@php
					 $i=1;
					@endphp	
			  @foreach ($TodayLiveData as $t)

				<?php 
				$cls = 0;
				$class_name = '';
				$section_name = '';
				$g_class_id = '';
				$subject_name = '';
				if($t->studentClass){
						 $class_name = $t->studentClass->class_name;
						 $cls = $t->studentClass->class_name;
						// $class_name = App\Http\Helpers\CommonHelper::addOrdinalNumberSuffix($t->studentClass->class_name);
						 $section_name = $t->studentClass->section_name;
						 $g_class_id = $t->studentClass->g_class_id;
					}
					if($t->studentSubject){
						$subject_name = $t->studentSubject->subject_name;
					}
				?>
			  
					<div class="classes-box">
						 <input type="hidden"  id="dateClass_id{{$i}}" value="{{$t->id}}">
						  <input type="hidden"  id="txt_class_id{{$i}}" value="{{$t->class_id}}">
						  <input type="hidden"  id="txt_subject_id{{$i}}" value="{{$t->subject_id}}">
						  <input type="hidden"  id="txt_teacher_id{{$i}}" value="{{$t->teacher_id}}">
						  
						  <input type="hidden"  id="txt_desc{{$i}}" value="{{$t->class_description}}">
						  <input type="hidden"  id="txt_gMeetURL{{$i}}" value="{{$teacherData->g_meet_url}}">
						  <input type="hidden"  id="txt_stdMessage{{$i}}" value="{{$t->class_student_msg}}">
						 
						
						 <input type="hidden" id="g_class_id_{{$i}}" value="{{ $g_class_id}}"/>
					
					
					  <div class="classes-datetime">
						<div class="cls-date">{{ $todaysDate }}</div>
						<div class="cls-from">{{$t->from_timing}}</div>
						<div class="cls-separater">to</div>
						<div class="cls-to">{{$t->to_timing}}</div>
					  </div>
					  <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
						<div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 
					
						{{ $class_name }} Std 
							
						</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> 
						{{$section_name}}
						</div>
						
						
						<div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> 
						
						{{$subject_name}}
						
						</div>
					  </div>
					   <div class="text-editwrapper">
							 <p class="mt-0 mb-2 text-secondary text-edit" data-url="#" data-savedesc="{{$i}}" contenteditable="true" id="class_description_{{$i}}" onchange="updateNote(this.value);">
							  @if($t->class_description!='')
								{{$t->class_description}}
							  @else
								 {{$t->class_description}}
							  @endif
							</p>
							<button type="button" class="btn btn-primary btn-sm">&#10003;</button>
					 </div>
					  <div class="d-flex justify-content-between flex-wrap py-2">
						<div>
						  <a href="javascript:void(0);" data-LiveLink="{{ $teacherData->g_meet_url }}" id="live_c_link_{{$i}}"  class=" btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_dot"></use></svg> Join Live
						  </a>
						  <a href="#" class=" btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow" id="new_a_link_{{$i}}"  data-createModal='{{$i}}' data-class_modal="{{$t->class_id}}" data-subject_modal="{{$t->subject_id}}"  data-teacher_modal="{{$t->teacher_id}}">
							<svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg>New Assignment
						  </a>
						  <?php 
						  $assignmentData =	App\Http\Helpers\CommonHelper::get_assignment_data($t->id);
						  ?>
						  <select id="view_a_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow" data-AssLiveLink="{{$t->id}}" />
						  <?php 
						   if(count($assignmentData)>0)
						  {	
								?> <option value="">View Assigment</option><?php 
								  foreach($assignmentData as $key){
									  ?>
									 <option value="{{$key->g_live_link}}">{{$key->g_title}} </option>
									  
									  <?php 
								  }
						  }else{
							  ?>
							  <option value="">No Assigment</option>
							  <?php 
						  }
						  
						  ?>
						  </select>
						  
						  
						  
						  
						  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow" data-notifyMe="{{$i}}" data-id="notify_student" id="notifyurl_{{$i}}">
							<svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_bell"></use></svg> <span>Notify Students</span> 
						  </a>
						</div>
						<div>
						  <button type="button" data-classhelp="{{$i}}" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="Help" data-id="help"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_help"></use></svg>
							Help 
						  </button>
						  <button type="button" data-editModal="{{$i}}" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit" ><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
						  </button>
						</div>
					  </div>
					  
					  <?php
						$topics = \DB::select('select * from tbl_student_subjects s, tbl_cmslinks c where c.subject = s.id and c.subject=? and c.class = ?', [$t->subject_id, $cls]);
						
						//if($t->subject_id == 2)
						//	dd($topics);
						
						//dd($topics);
						//App\Http\Helpers\CustomHelper::getCMSTopics($t->class_id,$t->subject_id);
					  ?>
					  
					  <div class="select-topicbox">
						<select class="form-control custom-select-sm border-0 btn-shadow" data-selecttopic="{{$t->id}}">
						    <option value="">Select Topic</option>
							  @if(count($topics)>0)
								@foreach($topics as $topic)
								  <?php $selected = ($topic->id==$t->topic_id)?'selected':'';?>
								  <option value="{{$topic->id}}" {{$selected}}>{{$topic->topic}}</option>
								@endforeach
							  @endif
							</select>
						</select>
						
						 <?php
                      $display_style = 'display: none;';
                     $cms_link = '';
                      if($t->topic_id != ''){
                        //  $display_style = 'display: block;';
                        }
                       if($t->cmsLink){
						 // $cms_link = $t->cmsLink->link;
					  }
                    ?>
                  
                    <a href="javascript:void(0);" data-topiclink="{{ $cms_link  }}" data-topicid="{{$t->topic_id}}" class="btn btn-outline-primary btn-sm btn-block mt-2 border-0 btn-shadow" id="viewcontent_{{$t->id}}" style="{{$display_style}}">
                      View Content
                    </a>
						
					  </div>
					</div>
					@php 
					$i++;	
					@endphp
				@endforeach
			@else
	
            <div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
              <svg class="icon icon-4x mr-3"><use xlink:href="../images/icons.svg#icon_nodate"></use></svg> No Record Found!
            </div>
			@endif
          </div>
				
          <!-- ///////////////// -->
          <!-- Past Live Classes -->
          <!-- ///////////////// -->
	  <div class="tab-pane fade" id="plclasses">
           
		  
		  @if(count($pastClassData) > 0)
				
					@php
					 $i=1;
				@endphp	
			  @foreach ($pastClassData as $t)
				<?php 
				$cls = 0;
				$section_name = '';
				$g_class_id = '';
				$class_name = '';
				$subject_name = '';
				if($t->studentClass){
						  $class_name = $t->studentClass->class_name;
						 //$class_name = App\Http\Helpers\CommonHelper::addOrdinalNumberSuffix($t->studentClass->class_name);
						 $section_name = $t->studentClass->section_name;
						 $g_class_id = $t->studentClass->g_class_id;
					}
					if($t->studentSubject){
						$subject_name = $t->studentSubject->subject_name;
					}
				?>
					
			  
					<div class="classes-box">
							
						<input type="hidden"  id="pastdateClass_id{{$i}}" value="{{$t->id}}">
						  <input type="hidden"  id="past_class_id{{$i}}" value="{{$t->class_id}}">
						  <input type="hidden"  id="past_subject_id{{$i}}" value="{{$t->subject_id}}">
						  
						  <input type="hidden"  id="past_desc{{$i}}" value="{{$t->class_description}}">
						  <input type="hidden"  id="past_gMeetURL{{$i}}" value="{{$t->g_meet_url}}">
						  <input type="hidden"  id="past_stdMessage{{$i}}" value="{{$t->class_student_msg}}">
						  <input type="hidden"  id="past_recURL{{$i}}" value="{{$t->recording_url}}">
						 
						
						 <input type="hidden" id="pastg_class_id_{{$i}}" value="{{ $g_class_id}}"/>
					<?php 
					
					$class_date = date("d M",strtotime($t->class_date));
					
					?>
					
					  <div class="classes-datetime">
						<div class="cls-date">{{ $class_date }}</div>
						<div class="cls-from">{{$t->from_timing}}</div>
						<div class="cls-separater">to</div>
						<div class="cls-to">{{$t->to_timing}}</div>
					  </div>
					  <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
						<div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> 
						
						{{$class_name}} Std</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> {{$section_name}}
					
						</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> 
					
						{{$subject_name}}
						
						</div>
					  </div>
					  
						
							 <p class="mt-0 mb-2 text-secondary text-edit" data-url="#" data-savedesc="{{$t->id}}" contenteditable="false" id="class_description_{{$i}}">
							  @if($t->class_description!='')
								{{$t->class_description}}
							  @else
								 {{$t->class_description}}
							  @endif
							</p>
					  
					 
					  <div class="d-flex justify-content-between flex-wrap py-2">
						<div>
						  <a href="javascript:void(0);" data-pastLiveLink="{{ $t->recording_url }}" id="past_live_c_link_{{$i}}"  class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Recording
						  </a>
						  
						     <?php 
						  $assignmentData =	App\Http\Helpers\CommonHelper::get_assignment_data($t->id);
						  ?>
						  <select id="past_asslive_c_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow" data-passAssLiveLink="{{$t->id}}" />
						  <?php 
						   if(count($assignmentData)>0)
						  {	
								?> <option value="">View Assignment</option><?php 
								  foreach($assignmentData as $key){
									  ?>
									 <option value="{{$key->g_live_link}}">{{$key->g_title}} </option>
									  
									  <?php 
								  }
						  }else{
							  ?>
							  <option value="">No Assignment</option>
							  <?php 
						  }
						  
						  ?>
						  </select>
						 
						
						  
						  
						  
					<!-- 	 <a href="javascript:void(0);" data-passAssLiveLink="{{ $t->ass_live_url }}" id="past_asslive_c_link_{{$i}}"  class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Assignment
						  </a>
						  <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow" id="new_a_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow" data-createModal='{{$i}}' data-class_modal="{{$t->class_id}}" data-subject_modal="{{$t->subject_id}}"  data-teacher_modal="{{$t->teacher_id}}">
							<svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add New Assignment
						  </a> 
						  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_bell"></use></svg> Notify Students 
						  </a> -->
						</div>
						<div>
					<!--	  <button type="button" data-classhelp="{{$i}}" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="Help" data-id="help"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_help"></use></svg>
							Help 
						  </button>-->
						  <button type="button" data-pasteditModal="{{$i}}" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit" ><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
						  </button> 
						</div>
					  </div>
					  
					  <?php
						$topics = App\Http\Helpers\CustomHelper::getCMSTopics($t->class_id,$t->subject_id)
					  ?>
					  
					  <div class="select-topicbox">
						<select class="form-control custom-select-sm border-0 btn-shadow" disabled data-selecttopic="{{$t->id}}">
						    <option value="">Select Topic</option>
							  @if(count($topics)>0)
								@foreach($topics as $topic)
								  <?php $selected = ($topic->id==$t->topic_id)?'selected':'';?>
								  <option value="{{$topic->id}}" {{$selected}}>{{$topic->topic}}</option>
								@endforeach
							  @endif
							</select>
						</select>
						
						 <?php
                      $display_style = 'display: none;';
                     $cms_link = '';
                      if($t->topic_id != ''){
                          $display_style = 'display: block;';
                        }
						
                      if($t->cmsLink){
						  $cms_link = $t->cmsLink->link;
					  }
                    ?>
                  
                    <a href="javascript:void(0);" data-pasttopiclink="{{ $cms_link }}" data-pasttopicid="{{$t->topic_id}}" class="btn btn-outline-primary btn-sm btn-block mt-2 border-0 btn-shadow" id="pastviewcontent_{{$t->id}}" style="{{$display_style}}">
                      View Content
                    </a>
						
					  </div>
					</div>
					@php 
					$i++;	
					@endphp
				@endforeach
			@else

		<div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
              <svg class="icon icon-4x mr-3"><use xlink:href="../images/icons.svg#icon_nodate"></use></svg> No Record Found!
            </div>
			@endif
          </div>
		  
		 
<!---  
Invitation
 -->
		 <div class="tab-pane fade" id="newInvitationclasses">
		 
		   <div class="col-sm-12">
          <table id="teacherlist" class="table table-sm table-bordered display" style="width:100%" data-page-length="25" data-order="[[ 1, &quot;asc&quot; ]]" data-col1="60" data-collast="120" data-filterplaceholder="Search Records ...">
            <thead>
              <tr>
                <th>#</th>
                <th>Class</th>
                <th>Section</th>
                <th>Subject</th>
                <th>Link</th>
				  </tr>
            </thead>
            <tbody>
			<?php 
			 if(count($inviteClassData)>0)
			{
			$i=0;
				foreach($inviteClassData as $row)
				{	
				$section_name ='';
				$subject_name = '';
				$cls = '';
				$g_link = '';
					if($row->studentClass){
						 $cls = $row->studentClass->class_name;
						 $section_name = $row->studentClass->section_name;
						 $g_link = $row->studentClass->g_link;
					}
					if($row->studentSubject){
						$subject_name = $row->studentSubject->subject_name;
					}
					?>
					<tr>
						<td>{{++$i}}</td>
						<td>{{ $cls }} Std  </td>
						<td>{{ $section_name }}</td>
						<td>{{ $subject_name }}</td>
						<td> <a href="javascript:void(0);" data-INVLiveLink="{{ $g_link }}" id="Inv_live_c_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
						<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_dot"></use></svg> Go Live
					  </a></td>
				  </tr>
					
					<?php 
					
				}
				$i++;	
			}
			else
			{
				?>
					<div class="classes-box min-height-auto py-4 p-4 text-danger text-center">
					  <svg class="icon icon-4x mr-3"><use xlink:href="../images/icons.svg#icon_nodate"></use></svg> No Record Found!
					</div>
				<?php 
			}	
				?>
            </tbody>
          </table>
        </div>
		</div>
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
				<label  class="col-md-6 col-form-label text-md-right">Select From Existing Assignment :</label>
			 
				<div class="col-md-6">
					<ul class="pl-4" id="li_assignment">
							
					  </ul>
				</div>
			</div>
		<span class="modal-header bg-light"></span>	
		 <div class="form-group row">
				<label class="col-md-6 col-form-label text-md-right"> OR Create New</label>
			
		 </div>
          <input type="hidden"  id="row_id" value="">
          <input type="hidden"  id="new_assignment" value="">
          <input type="hidden"  id="g_class_id" value="">
          <input type="hidden"  id="ass_class_id" value="">
          <input type="hidden"  id="ass_subject_id" value="">
          <input type="hidden"  id="ass_teacher_id" value="">
		  
		  
			
				  <div class="form-group row">
					<label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">Select Topic :</label>
					<div class="col-md-6">
						<select name="sel_topic" id="sel_topic" class="form-control">
							<option value="">Select Topic</option>
						</select>
					</div>
				  </div>
				  
				<div class="form-group row">
					<label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">OR Enter New Topic :</label>
					<div class="col-md-6">
						<input type="text" id="txt_topin_name" class="form-control" placeholder="Topic Name" />
					</div>
				  </div>
		  
		  
          <div class="form-group row">
            <label for="inputAddquiz" class="col-md-4 col-form-label text-md-right"> Assignment Title :</label>
            <div class="col-md-6">
              <input type="text" class="form-control" name="txt_aTitle" id="txt_aTitle" placeholder="Assigment Title">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" id="assignment_create" class="btn btn-primary px-4">Next</button>
			  
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>



<!-- Class Box Help Modal -->
<div class="modal fade" id="classhelpModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Help Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        <form>
          <div class="form-group">
            <textarea class="form-control" value="" rows="5" placeholder="Write help message..." required="required"></textarea>
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary px-4">
              <svg class="icon mr-2"><use xlink:href="../images/icons.svg#icon_send"></use></svg> Send
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Add Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        
		 {!! Form::open(array('route' => ['add.class'],'method'=>'POST','autocomplete'=>'off','id'=>'frm_add_class')) !!}
          <div class="form-group row">
            <label for="addinputDate" class="col-md-4 col-form-label text-md-right">Date:</label>
            <div class="col-md-6">
              {!! Form::text('class_date', null, array('placeholder' => 'DD MM YYYY','class' => 'form-control ac-datepicker','required'=>'required',"onkeydown"=>"return false;")) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputFtime" class="col-md-4 col-form-label text-md-right">Class From Time:</label>
            <div class="col-md-6">
             {!! Form::text('start_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
            <div class="col-md-6">
              {!! Form::text('end_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required',"onkeydown"=>"return false;")) !!}
            </div>
          </div>

			
          <div class="form-group row">
		    <label class="col-md-12 text-danger text-center" style="font-size: 12px;padding-left: 130px;">*Extra classes for regular assigned classes can be created here</label>
            <label for="addclassChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
            <div class="col-md-6">
             <select name="class_id" id="class_id" class="form-control" required>
			  <option value=""> Select Class </option>
				<?php 
				  foreach($data['classData'] as $row){
					  ?>
					 
					  <option value="<?= $row->id; ?>"> <?= 'Class '.$row->class_name.' - '.$row->section_name.' - '.$row->subject_name; ?></option>
					  <?php 
				  }
				  
				  ?>
					</select>
            </div>
          </div>
       
         
			<!-- <div class="form-group row">
				<label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
				<div class="col-md-6">
				  {!! Form::textarea('join_liveUrl', null, array('placeholder' => 'Enter Live class url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
				</div>
			  </div> -->
		 
          <div class="form-group row">
            <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify Students:</label>
            <div class="col-md-6">
            
			  {!! Form::textarea('notify_stdMessage', null, array('placeholder' => 'Enter Notify Message','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-primary px-4">Save Class</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End -->

<!-- Edit Class Modal -->
<div class="modal fade" id="editClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Edit Class Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        
		 {!! Form::open(array('route' => ['edit.class'],'method'=>'POST','autocomplete'=>'off','id'=>'frm_class_edit')) !!}
         
		 
				<input type="hidden" id="txt_datecalss_id" value="" name="txt_datecalss_id" />
		 
          <div class="form-group row">
            <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
            <div class="col-md-6">
              {!! Form::textarea('edit_description', null, array('id'=>'edit_description','placeholder' => 'Class Description','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
            </div>
          </div>
         <div class="form-group row">
				<label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
				<div class="col-md-6">
				  {!! Form::textarea('edit_join_liveUrl',$teacherData->g_meet_url, array('id'=>'edit_join_liveUrl','placeholder' => 'Enter Live class url','class' => 'form-control','required'=>'required','rows'=>'3','disabled')) !!}
				</div>
			  </div>
          <div class="form-group row">
            <label for="inputNotifystd" class="col-md-4 col-form-label text-md-right">Notify Students:</label>
            <div class="col-md-6">
            
			  {!! Form::textarea('edit_notify_stdMessage', null, array('id'=>'edit_notify_stdMessage','placeholder' => 'Enter Notify Message','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="submit" class="btn btn-primary px-4">Save Class</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End -->
<!-- Past Edit Class Modal -->
<div class="modal fade" id="pasteditClassModal" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-light d-flex align-items-center">
        <h5 class="modal-title font-weight-bold">Edit Past Class Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg class="icon"><use xlink:href="../images/icons.svg#icon_times2"></use></svg>
        </button>
      </div>
      <div class="modal-body pt-4">
        
		<form>
         
		 
				<input type="hidden" id="txt_past_datecalss_id" value="" name="txt_past_datecalss_id" />
				<input type="hidden" id="txt_boxID" value="" name="txt_boxID" />
		 
          <div class="form-group row">
            <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
            <div class="col-md-6">
              {!! Form::textarea('past_edit_description', null, array('id'=>'past_edit_description','placeholder' => 'Class Description','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
            </div>
          </div>
         <div class="form-group row">
				<label for="class_liveurl" class="col-md-4 col-form-label text-md-right"> Recording URL <small>(Link)</small>:</label>
				<div class="col-md-6">
				  {!! Form::textarea('past_edit_rec_liveUrl', null, array('id'=>'past_edit_rec_liveUrl','placeholder' => 'Enter Recording Live url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
				</div>
			  </div>
          <div class="form-group row">
            <div class="col-md-8 offset-md-4">
              <button type="button" id="update_pastClass" class="btn btn-primary px-4">Save Class</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End -->



<script type="text/javascript">
$(document).ready(function(){
  $('.ac-datepicker').datepicker({
    dateFormat: 'd M yy',
	minDate: 0,
  });
  $('.ac-time').timepicker({
    controlType: 'select',
    oneLine: true,
    timeFormat: 'hh:mm tt'
  });
}); 



$(document).on('click', '[data-LiveLink]', function(){
   var liveurl = $(this).attr("data-LiveLink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name");//, "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No Join link found!');
   }
});


$(document).on('change', '[data-AssLiveLink]', function(){
   var liveurl = $(this).val();
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});


$(document).on('click', '[data-topiclink]', function(){
   var liveurl = $(this).attr("data-topiclink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name");//, "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No content url found!');
   }
});

/*
past calsses 
*/

$(document).on('click', '[data-pastLiveLink]', function(){
   var liveurl = $(this).attr("data-pastLiveLink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No Video recording found!');
   }
});


$(document).on('click', '[data-pasttopiclink]', function(){
   var liveurl = $(this).attr("data-pasttopiclink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name");//, "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No content url found!');
   }
});


$(document).on('change', '[data-passAssLiveLink]', function(){
   var liveurl = $(this).val();
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});

$(document).on('click', '[data-pasteditModal]', function(){
 var val = $(this).data('pasteditmodal');
  $('#pasteditClassModal').modal('show');
 
  $("#past_edit_description").val($("#past_desc"+val).val());
  $("#past_edit_rec_liveUrl").val($("#past_recURL"+val).val());

  $("#txt_past_datecalss_id").val($("#pastdateClass_id"+val).val());
  $("#txt_boxID").val(val);
  
});

$(document).on('click', '#update_pastClass',(function(){
	var id =  $("#txt_boxID").val();
	var rec_url = $('#past_edit_rec_liveUrl').val();
	var desc = $('#past_edit_description').val();
	var dateClass_id =  $("#txt_past_datecalss_id").val();



 $.ajax({
      url: "{{url('edit-past-class')}}",
      type: "POST",
      data: {rec_url:rec_url,description:desc,dateClass_id:dateClass_id},
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(result){                          
          var response = JSON.parse(result);
          if(response.status == 'success'){
            
              $.fn.notifyMe('success', 5, response.message);
              $('#pasteditClassModal').modal('hide');
			  $('#past_live_c_link_'+id).attr('data-pastLiveLink',response.rec_url);
			  $("#past_desc"+id).val(desc);
			 $("#past_recURL"+id).val(response.rec_url);
				//window.open(response.cource_url,"title","dialogWidth:400px;dialogHeight:300px");
				
          }else{
              $.fn.notifyMe('error', 5, response.message);
          }
      }             
  });
}));


/* past classess end  */


$(document).on('click', '[data-INVLiveLink]', function(){
   var liveurl = $(this).attr("data-INVLiveLink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No Class url found!');
   }
});

$(document).on('click', '[data-createModal]', function(){
	var id = $(this).data('createmodal');
	$('#new_assignment').val($("#dateClass_id"+id).val());
	$("#row_id").val(id);
	$('#g_class_id').val($('#g_class_id_'+id).val());
	$("#ass_class_id").val($('#txt_class_id'+id).val());
	$("#ass_subject_id").val($('#txt_subject_id'+id).val());
	$("#ass_teacher_id").val($('#txt_teacher_id'+id).val());
	
	var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
	var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
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
			  data: {class_id:class_id,subject_id:subject_id},
			  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			  success: function(result){                          
				  var response = JSON.parse(result);
				  if(response.status == 'success'){
					
					 var AssigmentData = response.data;
					 var topics = response.topics;
					 var data = '';
					 var topicData = '<option value="">Select Topic</option>';
					AssigmentData.forEach(function (val){
						 
						data += '<li> <a href="javascript:void(0);" onclick="give_assignment(\''+id+'\',\''+val.g_live_link+'\',\''+val.id+'\',\''+val.g_title+'\')" >'+ val.g_title +'</a>';
						data += ' ( <a  href="javascript:void(0);" data-viewAssignment="'+val.g_live_link+'" > View </a>) </li>';
						 
					 }); 
					 
					 topics.forEach(function (val){
						 
						topicData += '<option value="'+val.id+'">'+val.topicname+'</option>';
					
						 
					 }); 
					 
					 
					$("#sel_topic").html('');
					$("#sel_topic").append(topicData);
					$("#li_assignment").html('');	
					$("#li_assignment").append(data);	
					
				  }else{
					  $.fn.notifyMe('error', 5, response.message);
				  }
			  }             
		  });
});

function give_assignment(id,link,classwork_id,title)
{
	///console.log(id);
	//console.log(link);
	var dateClass_id = $('#new_assignment').val();
	//var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
	//var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
		 $.ajax({
			  url: "{{url('give-assignment')}}",
			  type: "POST",
			  data: {dateClass_id:dateClass_id,classwork_id:classwork_id},
			  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			  success: function(result){                          
				  
				///  console.log(result);
				  var response = JSON.parse(result);
				  
				  
				  if(response.status == 'success'){
					  //$('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
					  var data = '<option value="'+link+'">'+title+'</option>';
					  $('#view_a_link_'+id).append(data);
					  $.fn.notifyMe('success', 5, response.message);
					  $('#createAssiModal').modal('hide');
					
				  }else{
					  $.fn.notifyMe('error', 5, response.message);
				  }
			  }             
		  });
	
	
}


$(document).on('click', '#assignment_create',(function(){
 var id = $("#row_id").val();
var class_id = $('#ass_class_id').val();
var subject_id = $('#ass_subject_id').val();
var teacher_id = $('#ass_teacher_id').val();
//var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');

var g_class_id = $('#g_class_id').val();

var txt_topic_name = $('#txt_topin_name').val();
var sel_topic_name = $('#sel_topic').val();
var assignment_title = $('#txt_aTitle').val();
var dateClass_id = $('#new_assignment').val();


 $.ajax({
      url: "{{url('create-assignment')}}",
      type: "POST",
      data: {g_class_id:g_class_id,txt_topic_name:txt_topic_name,sel_topic_name:sel_topic_name,assignment_title:assignment_title,class_id:class_id,subject_id:subject_id,teacher_id:teacher_id,dateClass_id:dateClass_id},
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(result){                          
          var response = JSON.parse(result);
		
          if(response.status == 'success'){
            
              $.fn.notifyMe('success', 5, response.message);
              $('#createAssiModal').modal('hide');
				window.open(response.cource_url,"title","dialogWidth:400px;dialogHeight:300px");
				 var data = '<option value="'+response.cource_url+'">'+assignment_title+'</option>';
				  $('#view_a_link_'+id).append(data);
				
		  }else{
              $.fn.notifyMe('error', 5, response.message);
          }
      }             
  });
}));


$(document).on('change', '[data-selecttopic]', function(){
  var getid = $(this).attr('data-selecttopic');
  if($(this).val()!=''){
    
	var topic_id = $(this).val();
	
	var dateWork_id = getid;
	
     if(dateWork_id!='')
    {
      $.ajax({
          type:'POST',
          url:'{{ route("classtopic.update") }}',
          headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          data:{'id':dateWork_id,'topic_id':topic_id},
        success: function(result){
          var response = JSON.parse(result);
		  $('#viewcontent_'+dateWork_id).attr('style','display:block');
		  $('#viewcontent_'+dateWork_id).attr('data-topiclink',response.topic_link);
          $.fn.notifyMe('success',4,response.message);
        },
        error: function(){
          $.fn.notifyMe('error',4,'There is some error while saving description text!');
        }
      });  
    }    
  }
  else{
    $('#'+getid).hide();    
  }
});


/*help ajax */
$('[data-id=help]').click(function(){
  var getBoxId = $(this).attr("data-classhelp");
 
  var dateClass_id = $("#dateClass_id"+getBoxId).val();
  var class_id = $("#txt_class_id"+getBoxId).val();
  var subject_id = $("#txt_subject_id"+getBoxId).val();
  var description = $('#class_description_'+getBoxId).text();
  var joinlive = $('#live_c_link_'+getBoxId).attr('data-LiveLink');

  
  var help_type = 2;
     $.ajax({
        url: "{{route('teacher.generate_ticket')}}",
        type: "POST",
        data: {class_id:class_id,subject_id:subject_id,help_type:help_type,description:description,joinlive:joinlive,dateClass_id:dateClass_id},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(result){                          
          var response = JSON.parse(result);
          if(response.status == 'success'){ 
            $.fn.notifyMe('success', 5, response.message);
          }else{
            $.fn.notifyMe('error', 5, response.message);
          } 
        },
        error: function(error_r){ 
          var obj = JSON.parse(error_r.responseText);
          $.each(obj.errors, function(key,value) {
            $.fn.notifyMe('error', 5, value);
          }); 
        } 
  }); 
});




$(document).on('click', '[data-editModal]', function(){
 var val = $(this).data('editmodal');
  $('#editClassModal').modal('show');
 
  $("#edit_description").val($("#txt_desc"+val).val());
  $("#edit_join_liveUrl").val($("#txt_gMeetURL"+val).val());
  $("#edit_notify_stdMessage").val($("#txt_stdMessage"+val).val());
 
  $("#txt_datecalss_id").val($("#dateClass_id"+val).val());
  
});



$("#frm_class_edit").on('submit',(function(e){
 // e.preventDefault();
  var dateClass_id = $("#txt_datecalss_id").val();
  var description = $("#edit_description").val();
  var join_liveUrl = $("#edit_join_liveUrl").val();
  var notify_stdMessage = $("#edit_notify_stdMessage").val();
  
  
  $.ajax({
      url: "{{url('edit-live-class')}}",
      type: "POST",
      data: {dateClass_id:dateClass_id,description:description,join_liveUrl:join_liveUrl,notify_stdMessage:notify_stdMessage },
      contentType: false,
      cache: false,
      processData:false,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(result){                          
          var response = JSON.parse(result);
          //console.log(response.data);
          if(response.status == 'success'){
                
			  $("#liveurl_"+dateClass_id).attr("data-livelink", join_liveUrl);
              $('#editClassModal').modal('hide'); 
              $.fn.notifyMe('success', 5, response.message);
          }else{
              $.fn.notifyMe('error', 5, response.message);
          } 
          
      },
      error: function(error_r){ 
          var obj = JSON.parse(error_r.responseText);
          console.log(obj);
          $.each(obj.errors, function(key,value) {
            $.fn.notifyMe('error', 5, value);
          }); 
      }             
  });
}));

/* INvitaion Accept */

$('[data-id=accept]').click(function(){
  var id = $(this).attr("data-invaccept");
  var g_code = $("#txt_inv_code"+id).val();
  var inv_id = $("#txt_inv_id"+id).val();
 
	//alert(id);
	
     $.ajax({
        url: "{{route('teacher.acceptClass')}}",
        type: "POST",
        data: {id:inv_id,g_code:g_code},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(result){                          
          var response = JSON.parse(result);
          if(response.status == 'success'){ 
            $.fn.notifyMe('success', 5, response.message);
          }else{
            $.fn.notifyMe('error', 5, response.message);
          } 
        },
        error: function(error_r){ 
          var obj = JSON.parse(error_r.responseText);
          $.each(obj.errors, function(key,value) {
            $.fn.notifyMe('error', 5, value);
          }); 
        } 
  }); 
});

$(document).on('click', '[data-viewAssignment]', function(){
   var liveurl = $(this).attr("data-viewAssignment");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});


// NOtify Students
$('[data-id=notify_student]').click(function(){
  var getBoxId = $(this).attr("data-notifyMe");
  var dateClass_id = $("#dateClass_id"+getBoxId).val();
  var class_id = $("#txt_class_id"+getBoxId).val();
  var subject_id = $("#txt_subject_id"+getBoxId).val();
  var g_meet_url = $("#txt_gMeetURL"+getBoxId).val();
  
  if(g_meet_url == '')
  {
	  $.fn.notifyMe('error', 5,'First update the JOIN LIVE class link');
	  return false;
  }
  
  
	 $.ajax({
        url: '{{ url("student-notify") }}',
        type: "POST",
        data: {class_id:class_id,subject_id:subject_id,dateClass_id:dateClass_id,g_meet_url:g_meet_url},
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        beforeSend: function() {
            $(this).prop('disable', true);
            $('#notifyurl_'+getBoxId+' span').text('Sending...');
        },
        success: function(result){                          
          var response = JSON.parse(result);
          if(response.status == 'success'){ 
            $.fn.notifyMe('success', 5, response.message);
          }else{
            $.fn.notifyMe('error', 5, response.message);
          } 
        },
        complete: function() {
            $(this).prop('disable', false);
            $('#notifyurl_'+getBoxId+' span').text('Notify Students');
        },
        error: function(error_r){ 
            $(this).prop('disable', false);
            $('#notifyurl_'+getBoxId+' span').text('Notify Students');
            
            var obj = JSON.parse(error_r.responseText);
            $.each(obj.errors, function(key,value) {
                $.fn.notifyMe('error', 5, value);
            }); 
        } 
    });
    
});



// Description or Class  note 

$(document).on('click', '.text-editwrapper button', function(){
  var thiz = $(this);
  var id = thiz.parent().find('.text-edit').attr('data-savedesc');
  var getDescText = (thiz.parent().find('.text-edit').text().replace(/\$/g, '')).trim();
  var dateClass_id = $("#dateClass_id"+id).val();

 
  if(getDescText==''){
    $.fn.notifyMe('error',4,'Class Note can not be blank!');
  }else{
    $.ajax({
      type:'POST',
      url:'{{ url("update-classNotes") }}',
      headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      data:{'dateClass_id':dateClass_id,'description':getDescText},
      success: function(result){
		 
		var response = JSON.parse(result);	
		
		 if(response.status == 'success'){ 
            $.fn.notifyMe('success', 5, response.message);
			$("#txt_desc"+id).val(getDescText);
          }else{
            $.fn.notifyMe('error', 5, response.message);
          } 
		
		
		//$.fn.notifyMe('success',4,'Description has been saved!');
      },
      error: function(){
       // thiz.parent().find('.text-edit').removeClass('active');
        $.fn.notifyMe('error',4,'There is some error while saving class note text!');
      }
    });
  }
  
});


</script>

@endsection

