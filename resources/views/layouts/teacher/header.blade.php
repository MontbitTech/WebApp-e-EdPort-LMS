<!-- Navigation -->
<nav class="navbar fixed-top navbar-expand-xl bg-light">
  <div class="menu-bars">
    <svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_bars')}}"></use></svg>
  </div>
  <div class="container">
    <a class="navbar-brand" href="./home" title="E-Learning">E-Learning</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-expanded="false">
      <span class="navbar-toggler-icon">
        <svg class="icon icon-2x"><use xlink:href="{{asset('images/icons.svg#icon_vdots')}}"></use></svg>
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupport">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(2) == 'home'?'active':''}}" href="{{route('teacher.dashboard')}}">
            <svg class="icon icon-2x mr-1"><use xlink:href="{{asset('images/icons.svg#icon_monitor')}}"></use></svg> Class
          </a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link {{ Request::segment(2) == 'quiz'?'active':''}}" href="{{route('teacher.quiz')}}">
            <svg class="icon icon-1x mr-1"><use xlink:href="{{asset('images/icons.svg#icon_puzzle')}}"></use></svg> Quiz
          </a>
        </li>-->
        <li class="nav-item">
          <a class="nav-link {{ Request::segment(2) == 'assignment'?'active':''}}" href="{{route('teacher.assignment')}}">
            <svg class="icon mr-1"><use xlink:href="{{asset('images/icons.svg#icon_file')}}"></use></svg> Assignments
          </a>
        </li>        
        <!--<li class="nav-item">
          <a class="nav-link {{ Request::segment(2) == 'report'?'active':''}}" href="{{route('teacher.report')}}">
            <svg class="icon mr-1"><use xlink:href="{{asset('images/icons.svg#icon_chart')}}"></use></svg> Report
          </a>
        </li>  -->      
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('teacher.logout') }}" ><svg class="icon mmb-2 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_logout')}}"></use></svg> Logout</a>
          <!--  <form id="logout-form" action="#" method="POST" style="display: none;">
                @csrf
            </form> -->
          </a>
        </li>
        <li class="nav-item">
          <button type="button" class="btn btn-primary header-help" data-toggle="modal" href="#classhelpModal" role="modal">
            <svg class="icon mr-1"><use xlink:href="{{asset('images/icons.svg#icon_help')}}"></use></svg> Help!
          </button>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End -->


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
            <textarea class="form-control" value="" rows="5" id="desc" placeholder="Write help message..." required="required"></textarea>
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-primary px-4" id="btn_help">
              <svg class="icon mr-2"><use xlink:href="../images/icons.svg#icon_send"></use></svg> Send
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $('#btn_help').click(function(e){
     e.preventDefault();
   
     var desc = $("#desc").val();
     var help_type = 1;
	 
	 if(desc != '')
	 {
     /*Ajax Request Header setup*/
			 $.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
				 /* Submit form data using ajax*/
			  $('.loader').show();
			  $.ajax({
				url: "{{ route('generate-Ghelp')}}",
				method: 'post',
				data: {desc:desc,help_type:help_type},
				success: function(response){
				  $('.loader').fadeOut();
				   //------------------------
					  var result = JSON.parse(response);
					  if(result.status == 'success'){
						$.fn.notifyMe('success', 5, result.message);
					  }else if(result.status == 'error'){
						$.fn.notifyMe('error', 5, result.message);
					  }
					  else{
						alert('Something went wrong. Please try again');
					  }
						$('#classhelpModal').modal('hide'); 
						$("#desc").val('');
				   //--------------------------
				},
				error:function(){
				  $('.loader').fadeOut();
				  $.fn.notifyMe('danger', 5, 'Something went wrong. Please try again');
				},
				complete:function(){
				  $('.loader').fadeOut();
				}
			  });
	 }
	 else
	 {
		  $.fn.notifyMe('danger', 5, 'Help Message required.');
	 }
   });
</script>
