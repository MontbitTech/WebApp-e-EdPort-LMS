@extends('layouts.teacher.app')
@php $i = 1;$k=$i;@endphp
@section('content')

<?php 
$count = '';
if(count($inviteClassData)>0)
{
	$count = '('.count($inviteClassData).')';
}

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
            <a class="nav-link shadow-sm" data-toggle="tab" href="#newInvitationclasses" role="tab">New Invitation {{ $count }}</a>
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
				
					
				
					<div class="classes-box">
						 <input type="hidden"  id="dateClass_id{{$i}}" value="{{$t->id}}">
						  <input type="hidden"  id="txt_class_id{{$i}}" value="{{$t->class_id}}">
						  <input type="hidden"  id="txt_subject_id{{$i}}" value="{{$t->subject_id}}">
						  
						  <input type="hidden"  id="txt_desc{{$i}}" value="{{$t->class_description}}">
						  <input type="hidden"  id="txt_gMeetURL{{$i}}" value="{{$t->g_meet_url}}">
						  <input type="hidden"  id="txt_stdMessage{{$i}}" value="{{$t->class_student_msg}}">
						 
						
						 <input type="hidden" id="g_class_id_{{$i}}" value="{{ $t->studentClass->g_class_id}}"/>
					
					
					  <div class="classes-datetime">
						<div class="cls-date">{{ $todaysDate }}</div>
						<div class="cls-from">{{$t->from_timing}}</div>
						<div class="cls-separater">to</div>
						<div class="cls-to">{{$t->to_timing}}</div>
					  </div>
					  <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
						<div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> {{App\Http\Helpers\CustomHelper::addOrdinalNumberSuffix($t->studentClass->class_name)}} Std</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> {{$t->studentClass->section_name}}</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> {{$t->studentSubject->subject_name}}</div>
					  </div>
					  
						
							 <p class="mt-0 mb-2 text-secondary text-edit" data-url="#" data-savedesc="{{$t->id}}" contenteditable="true" id="class_description_{{$i}}">
							  @if($t->class_description!='')
								{{$t->class_description}}
							  @else
								 {{$t->class_description}}
							  @endif
							</p>
					  
					 
					  <div class="d-flex justify-content-between flex-wrap py-2">
						<div>
						  <a href="javascript:void(0);" data-LiveLink="{{ $t->g_meet_url }}" id="live_c_link_{{$i}}"  class=" btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_dot"></use></svg> Join Live
						  </a>
						  <a href="#" class=" btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow" id="new_a_link_{{$i}}"  data-createModal='{{$i}}' data-class_modal="{{$t->class_id}}" data-subject_modal="{{$t->subject_id}}"  data-teacher_modal="{{$t->teacher_id}}">
							<svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg>New Assignment
						  </a>
						  
						   <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow" id="view_a_link_{{$i}}" data-viewAssModal='{{$i}}' data-AssLiveLink="{{ $t->ass_live_url }}">
							<svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg>View Assignment
						  </a>
						  
						  
						  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_bell"></use></svg> Notify Students 
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
						$topics = App\Http\Helpers\CustomHelper::getCMSTopics($t->class_id,$t->subject_id);
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
                          $display_style = 'display: block;';
                        }
                       if($t->cmsLink){
						  $cms_link = $t->cmsLink->link;
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
				
					
			  
					<div class="classes-box">
							
						<input type="hidden"  id="pastdateClass_id{{$i}}" value="{{$t->id}}">
						  <input type="hidden"  id="past_class_id{{$i}}" value="{{$t->class_id}}">
						  <input type="hidden"  id="past_subject_id{{$i}}" value="{{$t->subject_id}}">
						  
						  <input type="hidden"  id="past_desc{{$i}}" value="{{$t->class_description}}">
						  <input type="hidden"  id="past_gMeetURL{{$i}}" value="{{$t->g_meet_url}}">
						  <input type="hidden"  id="past_stdMessage{{$i}}" value="{{$t->class_student_msg}}">
						 
						
						 <input type="hidden" id="pastg_class_id_{{$i}}" value="{{ $t->studentClass->g_class_id}}"/>
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
						<div class="font-weight-bold pt-1"><span class="text-secondary">Class:</span> {{App\Http\Helpers\CustomHelper::addOrdinalNumberSuffix($t->studentClass->class_name)}} Std</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Section:</span> {{$t->studentClass->section_name}}</div>
						<div class="font-weight-bold pt-1"><span class="text-secondary">Subject:</span> {{$t->studentSubject->subject_name}}</div>
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
						  <a href="javascript:void(0);" data-pastLiveLink="{{ $t->g_meet_url }}" id="past_live_c_link_{{$i}}"  class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Recording
						  </a>
						  
						  <a href="javascript:void(0);" data-passAssLiveLink="{{ $t->ass_live_url }}" id="past_asslive_c_link_{{$i}}"  class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_eye"></use></svg> View Assigment
						  </a>
						<!--  <a href="#" class="btn btn-sm btn-outline-primary mb-1 mr-2 border-0 btn-shadow" id="new_a_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow" data-createModal='{{$i}}' data-class_modal="{{$t->class_id}}" data-subject_modal="{{$t->subject_id}}"  data-teacher_modal="{{$t->teacher_id}}">
							<svg class="icon font-12 mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg> Add New Assignment
						  </a> 
						  <a href="#" class="btn btn-sm btn-outline-magenta mb-1 mr-2 border-0 btn-shadow">
							<svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_bell"></use></svg> Notify Students 
						  </a> -->
						</div>
						<div>
					<!--	  <button type="button" data-classhelp="{{$i}}" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="Help" data-id="help"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_help"></use></svg>
							Help 
						  </button>
						  <button type="button" data-editModal="{{$i}}" class="btn btn-sm btn-outline-secondary mb-1 border-0 btn-shadow" title="Edit" ><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_edit"></use></svg> Edit 
						  </button> -->
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
                     $cms_link = '#';
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
		 <?php 
		 if(count($inviteClassData)>0)
		{
			$i=0;
				foreach($inviteClassData as $row)
				{	
					$i++;	
					
					/* $subjectName = App\StudentSubject::where('id',$row->subject_id)->first();
					
					echo $subjectName->subject_name; */
			?>
				<input type="hidden" value="{{ $row->id }}" id="txt_inv_id{{$i}}"/>
				<input type="hidden" value="{{ $row->g_code }}" id="txt_inv_code{{$i}}"/>
				<div class="classes-box">
				 <div class="classes-datetime">
					<div class="cls-date"></div>
					<div class="cls-from"></div>
					<div class="cls-separater"></div>
					<div class="cls-to"></div>
				  </div> 
				  <div class="d-flex justify-content-between align-items-center flex-wrap pt-1 pb-2">
					<div class="font-weight-bold pt-1"><span class="text-secondary">Class : </span> {{App\Http\Helpers\CustomHelper::addOrdinalNumberSuffix($row->studentClass->class_name)}} Std</div>
					<div class="font-weight-bold pt-1"><span class="text-secondary">Section : </span>{{$row->studentClass->section_name}} </div>
					<div class="font-weight-bold pt-1"><span class="text-secondary">Subject : </span> </div>
				  </div>
				  <p class="mt-0 mb-2 text-secondary text-edit" contenteditable="false">
					
				  </p> 
				  <div class="d-flex justify-content-between flex-wrap py-2">
					<div>
					  <a href="javascript:void(0);" data-INVLiveLink="{{ $t->studentClass->g_link }}" id="Inv_live_c_link_{{$i}}" class="btn btn-sm btn-outline-success mb-1 mr-2 border-0 btn-shadow">
						<svg class="icon font-10 mr-1"><use xlink:href="../images/icons.svg#icon_dot"></use></svg> Go Live
					  </a>
					 
						
					 <button type="button" data-invaccept="{{$i}}" data-id="accept" class="btn btn-sm btn-outline-info mb-1 mr-2 border-0 btn-shadow" title="accept"><svg class="icon mr-1"><use xlink:href="../images/icons.svg#icon_plus"></use></svg>
							Accept
					  </button>	
						
					</div>
				  </div>
				   <div class="select-topicbox">
					
				   
				  </div>
				</div>
				<?php 
				}
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
          <input type="text"  id="new_assignment" value="">
          <input type="hidden"  id="g_class_id" value="">
          <div class="form-group row">
            <label for="inputJoinlive" class="col-md-4 col-form-label text-md-right">Topic Name :</label>
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
              {!! Form::text('class_date', null, array('placeholder' => 'DD MM YYYY','class' => 'form-control ac-datepicker','required'=>'required')) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputFtime" class="col-md-4 col-form-label text-md-right">Class From Time:</label>
            <div class="col-md-6">
             {!! Form::text('start_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required')) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputTtime" class="col-md-4 col-form-label text-md-right">Class To Time:</label>
            <div class="col-md-6">
              {!! Form::text('end_time', null, array('placeholder' => '00:00 AM/PM','class' => 'form-control ac-time','required'=>'required')) !!}
            </div>
          </div>
		  <div class="form-group row">
				<label for="colFormLabel" class="col-md-4 col-form-label text-md-right">Class Heading:</label>
				<div class="col-md-6">
				{!! Form::text('class_heading', null, array('placeholder' => 'Class Heading','class' => 'form-control','required'=>'required')) !!}
				</div>
				
			</div>
          <div class="form-group row">
            <label for="addclassChoose" class="col-md-4 col-form-label text-md-right">Class:</label>
            <div class="col-md-6">
             {!! Form::select('class_name', $data['class'], null,array('class' => 'form-control','required'=>'required')) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputSection" class="col-md-4 col-form-label text-md-right">Section:</label>
            <div class="col-md-6">
             {!! Form::select('section[]', $data['section'], null,array('class' => 'form-control','required'=>'required','multiple')) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="addinputSubject" class="col-md-4 col-form-label text-md-right">Subject:</label>
            <div class="col-md-6">
              {!! Form::select('subject', $data['subject'], null,array('class' => 'form-control','required'=>'required')) !!}
            </div>
          </div>
          <div class="form-group row">
            <label for="inputDesc" class="col-md-4 col-form-label text-md-right">Description:</label>
            <div class="col-md-6">
              {!! Form::textarea('description', null, array('placeholder' => 'Class Description','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
            </div>
          </div>
         
			 <div class="form-group row">
				<label for="class_liveurl" class="col-md-4 col-form-label text-md-right">Join Live <small>(Link)</small>:</label>
				<div class="col-md-6">
				  {!! Form::textarea('join_liveUrl', null, array('placeholder' => 'Enter Live class url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
				</div>
			  </div>
		 
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
				  {!! Form::textarea('edit_join_liveUrl', null, array('id'=>'edit_join_liveUrl','placeholder' => 'Enter Live class url','class' => 'form-control','required'=>'required','rows'=>'3')) !!}
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




<script type="text/javascript">
$(document).ready(function(){
  $('.ac-datepicker').datepicker({
    dateFormat: 'd M yy'
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
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});


$(document).on('click', '[data-AssLiveLink]', function(){
   var liveurl = $(this).attr("data-AssLiveLink");
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
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
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
    alert('No assignement url found!');
   }
});


$(document).on('click', '[data-pasttopiclink]', function(){
   var liveurl = $(this).attr("data-pasttopiclink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});


$(document).on('click', '[data-passAssLiveLink]', function(){
   var liveurl = $(this).attr("data-passAssLiveLink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});

/* past classess end  */


$(document).on('click', '[data-INVLiveLink]', function(){
   var liveurl = $(this).attr("data-INVLiveLink");
   if(liveurl!=''){
		//$('#viewClassModal').modal('show');
		//$("#thedialog").attr('src','https://google.com');
		window.open(liveurl,"dialog name", "dialogWidth:400px;dialogHeight:300px");
   }else{
    alert('No assignement url found!');
   }
});

$(document).on('click', '[data-createModal]', function(){
	var id = $(this).data('createmodal');
	$('#new_assignment').val($("#dateClass_id"+id).val());
	$('#g_class_id').val($('#g_class_id_'+id).val());
	// $('#old_assignment_url').val($('#old_a_link_'+editmodal).attr('href'));
	
	var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
	var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
	//var teacher_id = $('[data-createmodal="'+id+'"]').data('teacher_modal');

	
	/*  console.log(id);
	 console.log(class_id);
	console.log(subject_id); */
	
	
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
					 
					 var data = '';
					AssigmentData.forEach(function (val){
						 
						data += '<li> <a href="javascript:void(0);" onclick="give_assignment(\''+id+'\',\''+val.g_live_link+'\')" >'+ val.g_title +'</a></li>';
						 
					 }); 
					
					$("#li_assignment").html('');	
					$("#li_assignment").append(data);	
					
				  }else{
					  $.fn.notifyMe('error', 5, response.message);
				  }
			  }             
		  });
});

function give_assignment(id,link)
{
	///console.log(id);
	console.log(link);
	var dateClass_id = $('#new_assignment').val();
	var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
	var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
		 $.ajax({
			  url: "{{url('give-assignment')}}",
			  type: "POST",
			  data: {dateClass_id:dateClass_id,class_id:class_id,subject_id:subject_id,ass_live_url:link},
			  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			  success: function(result){                          
				  
				  console.log(result);
				  var response = JSON.parse(result);
				  
				  
				  if(response.status == 'success'){
					  //$('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
					  $('#view_a_link_'+id).attr('data-AssLiveLink',link);
					  $.fn.notifyMe('success', 5, response.message);
					  $('#createAssiModal').modal('hide');
					
				  }else{
					  $.fn.notifyMe('error', 5, response.message);
				  }
			  }             
		  });
	
	
}


$(document).on('click', '#assignment_create',(function(){
 var id = $('#new_assignment').val();
var class_id = $('[data-createmodal="'+id+'"]').data('class_modal');
var subject_id = $('[data-createmodal="'+id+'"]').data('subject_modal');
var teacher_id = $('[data-createmodal="'+id+'"]').data('teacher_modal');
//var timing_id = $('[data-createmodal="'+id+'"]').data('timing_modal');
var g_class_id = $('#g_class_id').val();
var topic_name = $('#txt_topin_name').val();
var assignment_title = $('#txt_aTitle').val();
var dateClass_id = id;



 $.ajax({
      url: "{{url('create-assignment')}}",
      type: "POST",
      data: {g_class_id:g_class_id,topic_name:topic_name,assignment_title:assignment_title,class_id:class_id,subject_id:subject_id,teacher_id:teacher_id,dateClass_id:dateClass_id},
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      success: function(result){                          
          var response = JSON.parse(result);
          if(response.status == 'success'){
              //$('#new_a_link_'+edit_assignment).attr('href',new_assignment_url);
              //$('#old_a_link_'+edit_assignment).attr('href',old_assignment_url);
              $.fn.notifyMe('success', 5, response.message);
              $('#createAssiModal').modal('hide');
				
				//$('#viewClassModal').modal('show');
				//$("#thedialog").attr('src', response.cource_url);
				window.open(response.cource_url,"title","dialogWidth:400px;dialogHeight:300px");
				
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



</script>

@endsection

