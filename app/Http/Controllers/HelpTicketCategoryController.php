<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use Illuminate\Http\Request;

class HelpTicketCategoryController extends Controller
{
    public function index(Request $request){
        $categories = HelpTicketCategory::get();

        return $categories;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show(Request $request, $id)
    {
        return view('admin.category', ['category' => HelpTicketCategory::findOrFail($id)]);
    }

    public function store(Request $request){
        $category = new HelpTicketCategory();
        $category->category = $request->category;
        $category->save();

        return true;
    }
}
