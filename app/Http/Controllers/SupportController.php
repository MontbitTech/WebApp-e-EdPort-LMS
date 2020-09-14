<?php

namespace App\Http\Controllers;

use App\Support;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Support::all();
        // dd($videos);
        return view('admin.video.index', compact('videos'));
        // ->with('videos', Support::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = new Support();
        $video->title = $request->title;
        $video->link = $request->link;
        $video->save();
        return back()->with('success', 'Video Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sid = decrypt($id);
        return view('admin.video.add')
            ->with('videos', Support::findorFail($sid));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sid = decrypt($id);
        $video = Support::findorFail($sid);
        $video->title = $request->title;
        $video->link = $request->link;
        $video->save();
        return redirect()
            ->route('video')
            ->with('success', 'Video Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->delete == 'delete') {
            $video = Support::findorFail($id);
            $video->delete();
            return back()->with('success', 'Video Deleted successfully');
        } else {
            return back()->with('error', "Type delete to confirm");
        }
    }
}
