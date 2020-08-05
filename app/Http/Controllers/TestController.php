<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use Session;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test (Request $request)
    {
       $class = ClassSection::firstOrCreate([
            'class_name'   => 12,
            'section_name' => 'C',
        ]);
        return \response()->json(['success' => 'true', 'message' => 'rest in peace bro...','data'=>$class]);
    }
}
