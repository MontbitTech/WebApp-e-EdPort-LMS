<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test (Request $request, $data=null)
    {
        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...','data'=>$data]);
    }
}
