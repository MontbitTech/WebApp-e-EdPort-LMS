<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventDetail;

class EventDetailController extends Controller
{
	public function index()
	{
	$eventDetails = EventDetail::get();
	return view('admin.eventdetail.index', compact('eventDetails'));
	}
}
