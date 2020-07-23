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
			<div class="col-4">

				<a href="/" class="btn-menu btn text-white	  " style="background-color:#253372;" id="menu-bar">
					<svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#icon_arrowdown')}}"></use>
					</svg>
				</a>
				<a class="navbar-logo align-middle font-weight-bold" href="./">
					e-EdPort
				</a>

			</div>
			<div class="col-8 dropdown-user">
				@if($t)

				<a href="" class="text-danger mr-2 icon-lg align-middle">

					<i class="fa fa-bell " style="font-size: 20px;" aria-hidden="true"></i>
				</a>

				@else
				<a href="" class="text-success mr-3 icon-lg align-bottom">

					<i class="fa fa-bell" style="font-size: 20px;" aria-hidden="true"></i>


				</a>
				@endif

				<div class="dropdown d-inline-block">

					<div class="dropdown-toggle" data-toggle="dropdown">
						<div class="user-profilepic"><img src="{{asset('images/user.jpg')}}" width="31px"></div><span>My Profile</span>
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
			<div class="left-link {{ Request::segment(1) == 'list-setting'?'active':''}}"><a href="{{route('admin.settings')}}" class="pl-3">

					<i class="fas fa-cogs icon icon-4x"></i>
					School Settings</a>
			</div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'dashboard'?'active':''}}"><a href="{{route('admin.dashboard')}}" class="pl-3">
					<i class="fas fa-chalkboard-teacher icon icon-4x"></i>
					Teacher
				</a>
			</div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'classes'?'active':''}}"><a href="{{route('admin.listClass')}}" class="{{$classes}} pl-3">

					<i class="fas fa-book-reader icon-4x icon"></i>
					Classes</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-timetable'?'active':''}}"><a href="{{route('list.timetable')}}" class="{{$timetable}} pl-3">
					<i class="fas fa-calendar-alt icon icon-4x"></i>
					Time Table</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-students'?'active':''}}"><a href="{{route('list.students')}}" class="{{$student}} pl-3">
					<i class="fas fa-user-graduate icon icon-4x"></i>

					Student</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(1) == 'list-topics'?'active':''}}"><a href="{{route('cms.listtopics')}}" class="{{$cmslinks}} pl-3">
					<i class="fas fa-clipboard-list icon icon-4x"></i>
					CMS Topics</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'support-help'?'active':''}}"><a href="{{route('admin.helplist')}}" class="{{$support}} pl-3">
					<i class="fas fa-receipt icon icon-4x"></i>
					Help Tickets</a></div>
		</div>
		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'help-category'?'active':''}}"><a href="{{route('admin.help-category')}}" class="{{$support}} pl-3">
					<i class="fa fa-code-fork icon icon-4x" aria-hidden="true"></i>
					Help Category</a></div>
		</div>
	</div>
</div>
<p class="copyrights">&copy;{{date('Y')}} LMS - All Rights Reserved</p>

</div>
<!-- End | Left Menu Bar -->