<div class="loading" style="display:flex;justify-content:center;align-items:center;position:fixed; top:0;left:0;width:100%;height:100%;z-index:1200;background:rgba(255,255,255,0.9);">
    <svg version="1.1" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
  <path fill="currentColor" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z"><animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.8s" repeatCount="indefinite"/></path></svg>
</div>

<header>
  <div class="container-fluid">
  	<div class="row">
	  	<div class="col-8">

	  		<button type="button" class="btn-menu" id="menu-bar">
  				<svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_arrowdown')}}"></use></svg>
  			</button>
	  		<a class="navbar-logo" href="./"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
			
	  	</div>
	  	<div class="col-4 dropdown-user">

	  		<div class="dropdown d-inline-block">
			
				  <div class="dropdown-toggle" data-toggle="dropdown">
				    <div class="user-profilepic"><img src="{{asset('images/user.jpg')}}"></div><span>Admin</span>
				  </div>
				  <div class="dropdown-menu dropdown-menu-right">
				  	<a class="dropdown-item" href="{{route('admin.profile')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_profile')}}"></use></svg>    Profile</a>
				  	<!-- <a class="dropdown-item" href="#">Change Password</a> -->
				    <div class="dropdown-divider"></div>
				   
				   <a class="dropdown-item" href="{{ route('admin.logout') }}">
		                <svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_logout')}}"></use></svg>    {{ __('Logout') }}
		              </a>
					  
					<!--  <a class="dropdown-item" href="#"
		                onclick="event.preventDefault();
		                document.getElementById('logout-form').submit();">
		                {{ __('Logout') }}
		              </a>

		              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
		                @csrf
		              </form> -->
				  </div>
				</div>
	  	</div>
	  </div>
	</div>
</header>

<!-- Start | Left Menu Bar -->
<div class="leftmenu-section">
	<div class="left-accordion" id="parentAccordion">
		  <div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'dashboard'?'active':''}}"><a href="{{route('admin.dashboard')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_teacher')}}"></use></svg>Teacher</a></div>
		  </div>
		  
		   <div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'classes'?'active':''}}"><a href="{{route('admin.listClass')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_listing')}}"></use></svg>Classes</a></div>
		  </div>
		  
		  <div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-students'?'active':''}}"><a href="{{route('list.students')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_listing')}}"></use></svg>Student</a></div>
		  </div>

		  <div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-timetable'?'active':''}}"><a href="{{route('list.timetable')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_calendar')}}"></use></svg>Time Table</a></div>
		  </div>

		   <div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-topics'?'active':''}}"><a href="{{route('cms.listtopics')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_listing')}}"></use></svg>CMS Topics</a></div>
		  </div>
		  
		  <div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'support-help'?'active':''}}"><a href="{{route('admin.helplist')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_support')}}"></use></svg>Help Tickets</a></div>
		  </div>
		  <div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-setting'?'active':''}}"><a href="{{route('admin.settings')}}"><svg class="icon"><use xlink:href="{{asset('images/icons.svg#icon_support')}}"></use></svg>Settings</a></div>
		  </div>
	  </div>
	</div>
	<p class="copyrights">&copy;{{date('Y')}} LMS - All Rights Reserved</p>

</div>
<!-- End | Left Menu Bar -->