<div class="loading" style="display:flex;justify-content:center;align-items:center;position:fixed; top:0;left:0;width:100%;height:100%;z-index:1200;background:rgba(255,255,255,0.9);">
	<svg version="1.1" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
		<path fill="currentColor" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
			<animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.8s" repeatCount="indefinite" />
		</path>
	</svg>
</div>
<style>
	a.disabled {
		pointer-events: none;
		cursor: default;
		background: grey;
	}

	.marquee {
		margin: 0 auto;
		white-space: nowrap;
		overflow: hidden;
		box-sizing: border-box;
	}

	.marquee span {
		display: inline-block;
		padding-left: 100%;
		will-change: transform;
		/* show the marquee just outside the paragraph */
		animation: marquee 15s linear infinite;
	}

	.marquee span:hover {
		animation-play-state: paused
	}


	/* Make it move */

	@keyframes marquee {
		0% {
			transform: translate(0, 0);
		}

		100% {
			transform: translate(-100%, 0);
		}
	}
</style>
@php
$student = "disabled";
$classes = "disabled";
$timetable ="disabled";
$cmslinks = "disabled";
$support = "disabled";

$s = \App\Http\Helpers\CustomHelper::enableOptions();
$t = \App\Http\Helpers\CustomHelper::latestTicket();

if($s["teacher"] > 0)
{
$classes = "enabled";
$support = "enabled";
}

if($s["classes"] > 0)
$timetable ="enabled";

if($s["timetable"] > 0)
$student ="enabled";

if($s["student"] > 0)
$cmslinks ="enabled";

@endphp

<header>
	<div class="container-fluid">
		<div class="row">
			<div class="col-10">

				<button type="button" class="btn-menu" id="menu-bar">
					<svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#icon_arrowdown')}}"></use>
					</svg>
				</button>
				<a class="navbar-logo" href="./"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
				@if(count($t) > 0)
				@php
				$dosc = "Ticket : " . $t[0]->name . "(" .$t[0]->phone . ")" . (!empty($t[0]->description) ? " - " .substr($t[0]->description, 30) : "");
				@endphp

				<div class='text-left col-lg-9' style="float:right;line-height: 3em;font-size:20px;">
					<p class="marquee">
						<span>
							<a target="_blank" style="color:indianred !important;" href='{{$t[0]->class_join_link}}'> {{$dosc}}</a>
						</span>
					</p>
				</div>
				@endif
			</div>
			<div class="col-2 dropdown-user">

				<div class="dropdown d-inline-block">

					<div class="dropdown-toggle" data-toggle="dropdown">
						<div class="user-profilepic"><img src="{{asset('images/user.jpg')}}"></div><span>Admin</span>
					</div>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{route('admin.profile')}}"><svg class="icon">
								<use xlink:href="{{asset('images/icons.svg#icon_profile')}}"></use>
							</svg> Profile</a>
						<!-- <a class="dropdown-item" href="#">Change Password</a> -->
						<div class="dropdown-divider"></div>

						<a class="dropdown-item" href="{{ route('admin.logout') }}">
							<svg class="icon">
								<use xlink:href="{{asset('images/icons.svg#icon_logout')}}"></use>
							</svg> {{ __('Logout') }}
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
			<div class="left-link {{ Request::segment(1) == 'list-setting'?'active':''}}"><a href="{{route('admin.settings')}}"><svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#schoolsetting')}}"></use>
					</svg>School Settings</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'dashboard'?'active':''}}"><a href="{{route('admin.dashboard')}}"><svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#teacher')}}"></use>
					</svg>Teacher</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'classes'?'active':''}}"><a href="{{route('admin.listClass')}}" class="{{$classes}}"><svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#class')}}"></use>
					</svg>Classes</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-timetable'?'active':''}}"><a href="{{route('list.timetable')}}" class="{{$timetable}}"><svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#timetable')}}"></use>
					</svg>Time Table</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-students'?'active':''}}"><a href="{{route('list.students')}}" class="{{$student}}"><svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#student')}}"></use>
					</svg>Student</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-topics'?'active':''}}"><a href="{{route('cms.listtopics')}}" class="{{$cmslinks}}"><svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#icon_listing')}}"></use>
					</svg>CMS Topics</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'support-help'?'active':''}}"><a href="{{route('admin.helplist')}}" class="{{$support}}"><svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#helptickets')}}" class="icon-8x"></use>
					</svg>Help Tickets</a></div>
		</div>
	</div>
</div>
<p class="copyrights">&copy;{{date('Y')}} LMS - All Rights Reserved</p>

</div>
<!-- End | Left Menu Bar -->