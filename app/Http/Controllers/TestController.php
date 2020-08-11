<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use Session;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test (Request $request)
    {
        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...','data'=>null]);
    }
}
