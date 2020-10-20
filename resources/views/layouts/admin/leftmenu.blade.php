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

	.color-change {
		animation: myanimation 1s infinite;
	}

	@keyframes myanimation {
		0% {
			color: red;
		}

		25% {
			color: red;
		}

		50% {
			color: lightgoldenrodyellow;
		}

		75% {
			color: lightgoldenrodyellow;
		}

		100% {
			color: red;
		}
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

	@media(max-width: 992px) {
		.leftmenu-section {
			left: -260px;
		}

		.menu-open .leftmenu-section {
			left: 0;
		}
	}

	@media(min-width: 1200px) {
		.menu-open .leftmenu-section {
			left: -260px;
		}

		.menu-open .main-section {
			padding-left: 0;
		}
	}

	.menu-bars {
		cursor: pointer;
		padding-right: 8px;
	}

	.menu-bars svg {
		font-size: x-large;
	}

	.dropdown-toggle::after {
		display: none !important;

	}

	.logout:hover {
		color: red !important;
	}

	.dropdown-menu.dropdown-menu-right.show {
		border-style: groove;
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
$pending = \App\Http\Helpers\CustomHelper::pendingTicket();

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
$s = \App\Http\Helpers\CustomHelper::getSchool();
@endphp
@php
$s = \App\Http\Helpers\CustomHelper::getSchool();

foreach($s as $logo)
{
if($logo->item == "schoollogo"){
$slogo = $logo->value;
}
}
@endphp
<header>

	<div class="container-fluid">
		<div class="row" style="display: inline;">
			<div class=" float-left">

				<!-- <a href="#" class="btn-menu btn text-white menu-bars" style="background-color:#253372;" id="menu-bar">
				</a> -->
				<!-- <i class="fa fa-bars menu-bars align-baseline pt-2 text-dark icon-4x" aria-hidden="true"></i> -->

				<div class="menu-bars d-inline">
					<svg class="icon">
						<use xlink:href="{{asset('images/icons.svg#icon_bars')}}"></use>
					</svg>
				</div>

				<a class="navbar-logo align-middle font-weight-bold" href="./">

					<img src="{{$slogo}}" alt="" width="40px">
				</a>

			</div>
			<div class="float-right dropdown-user ">
				@if($pending)
 
				<a href="{{route('admin.helplist')}}" class=" color-change mr-2 icon-lg align-middle">Pending Ticket: {{$pending}}&nbsp;
                
                <i class="fa fa-bell " style="font-size:1.3125rem; padding-top: 0.75rem;" aria-hidden="true"></i>
				</a>

				@else
				<a href="{{route('admin.helplist')}}" class=" text-success mr-3 icon-lg align-bottom">
					<!-- Notifiction -->
					<i class="fa fa-bell" style="font-size:1.3125rem; padding-top: 0.75rem;" aria-hidden="true"></i>


				</a>
				@endif

				<div class="dropdown d-inline-block">

					<div class="dropdown-toggle" data-toggle="dropdown">
						<div class="user-profilepic" style="font-size: 25px;">
							<i class="fa fa-user-circle  icon-4x" style="color: #1a1a1a;font-size: larger;"></i>
						</div>
						<!-- <img src="{{asset('images/user.jpg')}}" width="31px"></div><span>My Profile</span> -->
					</div>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{route('admin.profile')}}">
							<!-- <svg class="icon">
								<use xlink:href="{{asset('images/icons.svg#icon_profile')}}"></use>
							</svg>  -->
							<i class="fa fa-user-circle-o icon-2x" aria-hidden="true"></i>

							Profile</a>
						<!-- <a class="dropdown-item" href="#">Change Password</a> -->
						<div class="dropdown-divider"></div>

						<a class="dropdown-item logout" href="{{ route('admin.logout') }}">
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
												</form> 
										-->
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<!-- Start | Left Menu Bar -->
<div class="leftmenu-section pb-4">
	<div class="left-accordion" id="parentAccordion">
		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'list-setting'?'active':''}}"><a href="{{route('admin.settings')}}" class="pl-3">

					<i class="fas fa-cogs icon icon-4x"></i>
					My Institution</a>
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
					Classroom</a></div>
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

					<i class="fas fa-book icon icon-4x"></i>
					Content</a></div>
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
		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'ongoingclass'?'active':''}}"><a href="{{route('ongoing.index')}}" class="{{$support}} pl-3">
					<i class="fab fa-readme icon icon-4x" aria-hidden="true"></i>

					Ongoing Class</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'csvuploads'?'active':''}}"><a href="{{route('csvuploads.index')}}" class="{{$support}} pl-3">
					<i class="fas fa-file-import icon icon-4x" aria-hidden="true"></i>

					Csv Uploads</a></div>
		</div>

		<div class="left-card">
			<div class="left-link {{ Request::segment(2) == 'reports'?'active':''}}"><a href="{{route('reports.index')}}" class="{{$support}} pl-3">
					<i class="fas fa-file-import icon icon-4x" aria-hidden="true"></i>

					Reports</a></div>
		</div>

		<div class="text-center text-white w-100 " style="position:absolute;bottom:0;font-size: 10px;letter-spacing: 1px;">
			<img src="{{asset('images/logo-1.png')}}" alt="e-edport" width="50px">
			<div>Powered by e-EdPort</div>

		</div>
	</div>

</div>
<p class="copyrights">&copy;{{date('YS')}} LM - All Rights Reserved</p>

</div>
<!-- End | Left Menu Bar -->