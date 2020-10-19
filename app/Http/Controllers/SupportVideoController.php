<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\SupportVideo;
use Illuminate\Http\Request;

class SupportVideoController extends Controller
{
    public function index()
    {
        $videos = SupportVideo::all();

        return view('admin.video.index', compact('videos'));
    }
    public function store(Request $request)
    {
        $video = new SupportVideo();
        $video->title = $request->title;
        $video->link = $request->link;
        $video->save();

        return back()->with('success', 'Video Created successfully');
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $sid = decrypt($id);
            $video = SupportVideo::findorFail($sid);
            $video->title = $request->title;
            $video->link = $request->link;
            $video->save();
            return redirect()
                ->route('video')
                ->with('success', 'Video Updated successfully');
        } else {
            $sid = decrypt($id);
            return view('admin.video.add')
                ->with('videos', SupportVideo::findorFail($sid));
        }
    }
    
    public function destroy(Request $request, $id)
    {
        if ($request->delete == 'delete') {
            $video = SupportVideo::findorFail($id);
            $video->delete();
            return back()->with('success', 'Video Deleted successfully');
        } else {
            return back()->with('error', "Type delete to confirm");
        }
    }
}
