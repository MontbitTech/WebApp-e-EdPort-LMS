<?php

namespace App\Http\Controllers;

use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;
use Validator;
use App\CmsLink;
use App\StudentSubject;
use App\Models\ClassSection;
use Illuminate\Support\Facades\Log;
use App\Http\Helpers\CustomHelper;

class ImportCMSLinksController extends Controller
{
	public function addLink(Request $request)
	{
		$error = "";
		if ($request->isMethod('post')) {

			$request->validate([
				'subject' => 'required',
				'chapter' => 'required',
				'class'   => 'required',
				'topic'   => 'required',
				'link'    => 'required_without_all:khan_academy,youtube,others,alink,book_url|nullable|url',
				'khan_academy' => 'required_without_all:link,youtube,others,alink,book_url|nullable|url',
				'youtube'   => 'required_without_all:khan_academy,link,others,alink,book_url|nullable|url',
				'others'  => 'required_without_all:khan_academy,link,youtube,alink,book_url|nullable|url',
				'alink'   => 'required_without_all:khan_academy,link,youtube,others,book_url|nullable|url',
				'book_url'   => 'required_without_all:khan_academy,link,youtube,others,alink|nullable|url'
			],[
			
				'link.url' => 'Invalid e-Edport URL',
				'khan_academy.url' => 'Invalid My School URL',	
				'youtube.url' => 'Invalid Youtube URL',	
				'others.url' => 'Invalid Wikipedia URL',
				'alink.url' => 'Invalid Assignment URL',
				'book_url.url' => 'Invalid Book Url'						
			]);

			$studentClassExist = \DB::select(
				'select id from tbl_cmslinks where class=? and subject=? and chapter=? and topic=? and link=? and assignment_link=?',
				[$request["class"], $request["subject"], $request['chapter'], $request["topic"], $request["link"], $request["alink"],]
			);

			if ($studentClassExist) {
				Log::error('Link already exists.');
				$error = "found";
			} else
				$s = \DB::table('tbl_cmslinks')->insert(
					['class' => $request["class"], 'subject' => $request["subject"], 'chapter' => $request['chapter'], 'topic' => $request["topic"], 
					'book_url' => $request['book_url'], 'link' => $request["link"], 'khan_academy' => $request["khan_academy"], 'youtube' => $request["youtube"], 
					'others' => $request["others"], 'assignment_link' => $request["alink"]]
				);

			if ($error == "found")
				return redirect()->route('cms.listtopics')->with('error', 'CMS Topics/Links processed, check log file for errors!!');
			else
				return redirect()->route('cms.listtopics')->with('success', 'CMS Topics/Links details processed successfully');
		}

		$subjects = \DB::table('tbl_student_subjects')->get();
		$data['class'] = \DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name', 'class_name');
		$data['class']->prepend('Select Divison', '');
		
		return view('admin.cmslinks.add', compact('subjects', 'data'));
	}
	public function editLink(Request $request, $id)
	{
		// $regex  = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.*]*)([\/\w \.]*)([\/\w \.#]*)([\/\w \.?]*)([\/\w \.=]*)([\/\w \.-]*)*\/?$/';

		if ($request->isMethod('post')) {
			$request->validate([
				'subject' => 'required',
				'chapter' => 'required',
				'class'   => 'required',
				'topic'   => 'required',
				'link'    => 'required_without_all:khan_academy,youtube,others,alink,book_url|nullable|url',
				'khan_academy' => 'required_without_all:link,youtube,others,alink,book_url|nullable|url',
				'youtube'   => 'required_without_all:khan_academy,link,others,alink,book_url|nullable|url',
				'others'  => 'required_without_all:khan_academy,link,youtube,alink,book_url|nullable|url',
				'alink'   => 'required_without_all:khan_academy,link,youtube,others,book_url|nullable|url',
				'book_url'   => 'required_without_all:khan_academy,link,youtube,others,alink|nullable|url'
			],[
			
				'link.url' => 'Invalid e-Edport URL',
				'khan_academy.url' => 'Invalid My School URL',	
				'youtube.url' => 'Invalid Youtube URL',	
				'others.url' => 'Invalid Wikipedia URL',
				'alink.url' => 'Invalid Assignment URL',
				'book_url.url' => 'Invalid Book Url'						
			]);

			$id = decrypt($id);

			$s = \DB::table('tbl_cmslinks')->where('id', $id)->update(
				[
					'class' => $request["class"], 'subject' => $request["subject"], 'chapter' => $request['chapter'], 'topic' => $request["topic"], 'link' => $request["link"],
					'book_url' => $request['book_url'], 'youtube' => $request["youtube"], 'khan_academy' => $request["khan_academy"], 
					'others' => $request["others"], 'assignment_link' => $request["alink"]
				]
			);

			return redirect()->route('cms.listtopics')->with('success', Config::get('constants.WebMessageCode.112'));
		}

		$id = decrypt($id);

		$link = \DB::select('select * from tbl_cmslinks where id=?', [$id]);
		$subjects = \DB::table('tbl_student_subjects')->get();
		$data['class'] = \DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name', 'class_name');
		$data['class']->prepend('Select Divsion', '');
		return view('admin.cmslinks.edit', compact('link', 'subjects', 'data'));
	}

	public function deleteLink(Request $request, $id)
	{
		if (strtolower($request->delete) == 'delete') {
			//$sid = decrypt($id);
			//dd($sid);
			$student = \DB::table('tbl_cmslinks')->where('id', $id)->delete();

			$lists = \DB::select('select c.id, c.class, c.subject, s.subject_name, c.topic, c.link from tbl_cmslinks c, tbl_student_subjects s where c.subject = s.id');

			return redirect()->route('cms.listtopics')->with('success', 'Deleted Successfully');
		} else {
			return back()->with('error', "Type delete to confirm");
		}
	}


	public function listTopics()
	{
		$cms      = CmsLink::get();
		$classes  = ClassSection::orderByRaw("CAST(class_name as UNSIGNED) ASC")->get();
		$subjects = StudentSubject::get();
		return view('admin.cmslinks.index', compact('classes', 'subjects', 'cms'));
	}

	public function filterRecord(Request $request, CmsLink $cmslink)
	{
		$rec = $cmslink->newQuery();
		if (!empty($request->txtSerachClass == 'all-class')) {
			$getResult = $rec->get();
			if ($request->txtSerachSubject && $request->txtSerachSubject != 'all-subject') {
				$getResult = $rec->where('subject', $request->txtSerachSubject)->get();
			}
		} else if ($request->txtSerachClass && $request->txtSerachSubject == 'all-subject') {
			$getResult = $rec->where('class', $request->txtSerachClass)->get();
		} else if (!empty($request->txtSerachClass) && ($request->txtSerachClass != 'all-class')) {
			$getResult = $rec->where('class', $request->txtSerachClass)->get();
			if (!empty($request->txtSerachSubject && $request->txtSerachSubject != 'all-subject')) {
				$getResult = $rec->where('subject', $request->txtSerachSubject)->get();
			}
			if (!empty($request->txtSerachSubject && $request->txtSerachSubject == 'all-subject')) {
				$getResult = $rec->where('class', $request->txtSerachSubject)->get();
			}
		}

		return view('admin.cmslinks.filter-record', compact('getResult'));
	}

	public function sampleCMSLinksDownload(Request $request)
	{
		$path = public_path('cms-excels/sample/') . '/ClassSubjectTopicUrl.csv';

		return response()->download($path);
	}


	/*Import no of students in a class*/
	public function cmsLinksImport(Request $request)
	{
		// $student_class = \App\StudentClass::all();
		$error = "";
		if (Request()->post()) {
			$request->validate([
				'file' => 'required'
				//   'class' => 'required'
			]);
			try {

				$extensions = array("csv", "xlsx");
				$file_validate = strtolower($request->file('file')->getClientOriginalExtension());
				$rows = "";

				if (!in_array($file_validate, $extensions)) {
					return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
				}

				$file = $request->file('file');
				$destinationPath = public_path('cms-excels');

				$filename = $file->getClientOriginalName();

				if (file_exists($destinationPath . '/' . $filename))
					unlink($destinationPath . '/' . $filename);

				$file->move($destinationPath, $filename);

				$path = $destinationPath . '/' . $filename;

				$headerMissing = array();
				$supplierAdded = 0;
				$i = 1;
				$collection = (new FastExcel)->import($path);

				if (!isset($collection[0])) {
					return back()->with('error', Config::get('constants.WebMessageCode.104'));
				}
				$numbers = array();

				Log::info('Filename processing - ' . $filename);


				foreach ($collection as $key => $reader) {

					$class = \DB::table('tbl_classes')->select('class_name')->where('class_name', $reader["class"])->get();
					$subjects = \DB::table('tbl_student_subjects')->where('subject_name', $reader["subject"])->get();

					if (
						!isset($reader["class"]) || !isset($reader["subject"]) || !isset($reader["chapter"]) || !isset($reader["topic"]) || 
						!isset($reader["book_url"]) || !isset($reader["link"]) || !isset($reader["youtube"]) || !isset($reader["khan_academy"]) || 
						!isset($reader["others"]) || !isset($reader["assignment"])
					) {
						return back()->with('error', 'Header Mismatch at row: ' . $i);
					}

					if ($reader["class"] == "" || $reader["subject"] == "" || $reader["chapter"] == "" || $reader["topic"] == "") {
						Log::error('CMS details missing : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (!empty($reader["class"]) && count($class) == 0) {
						Log::error('Invalid Class name : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (!empty($reader["subject"]) && $subjects->count() == 0) {
						Log::error('Invalid subject name : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (!empty($reader["book_url"]) && !CustomHelper::is_url($reader['book_url'])) {
						Log::error('Invalid Link url : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					}elseif (!empty($reader["link"]) && !CustomHelper::is_url($reader['link'])) {
						Log::error('Invalid Link url : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (!empty($reader["youtube"]) && !CustomHelper::is_url($reader['youtube'])) {
						Log::error('Invalid Link url : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (!empty($reader["khan_academy"]) && !CustomHelper::is_url($reader['khan_academy'])) {
						Log::error('Invalid Link url : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (!empty($reader["others"]) && !CustomHelper::is_url($reader['others'])) {
						Log::error('Invalid Link url : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (!empty($reader["assignment"]) && !CustomHelper::is_url($reader['assignment'])) {
						Log::error('Invalid Assignment url : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} elseif (empty($reader["book_url"]) && empty($reader["link"]) && empty($reader["youtube"]) && empty($reader["khan_academy"]) && empty($reader["others"]) && empty($reader["assignment"])) {
						Log::error('Either one CMS link  should be present : ROW - ' . $i);
						$error = "found";
						$rows .= $i . ",";
					} else {
						//$subjects = \DB::table('tbl_student_subjects')->where('subject_name',$reader["subject"])->get();

						if ($subjects->count() > 0) {
							$studentClassExist = \DB::select('select id from tbl_cmslinks where class="' . $reader["class"] . '" and subject="' . $subjects[0]->id . '" and topic="' . $reader["topic"] . '" and link="' . $reader["link"] . '" and youtube="' . $reader["youtube"] . '"and khan_academy="' . $reader["khan_academy"] . '"and others="' . $reader["others"] . '" and assignment_link="' . $reader["assignment"] . '"and book_url="' . $reader["book_url"] . '"');

							if (count($studentClassExist) > 0) {
								Log::error('Link already exists : ROW - ' . $i);
								$error = "found";
								$rows .= $i . ",";
							} else {
								$s = \DB::table('tbl_cmslinks')->insert(
									[
										'class' => $reader["class"],'chapter' => $reader["chapter"], 'subject' => $subjects[0]->id, 'topic' => $reader["topic"], 
										'link' => $reader["link"], 'book_url' => $reader["book_url"], 'youtube' => $reader["youtube"], 
										'khan_academy' => $reader["khan_academy"], 'others' => $reader["others"], 'assignment_link' => $reader["assignment"]
									]
								);
							}
						} else {
							Log::error('Subject not found : ROW - ' . $i);
							$rows .= $i . ",";
						}
					}

					$i += 1;
				}

				Log::info('File processing done ');

				if ($error == "found")
					return back()->with('error', 'CMS Topics/Links processed, error in ROWS - ' . $rows);
				else
					return back()->with('success', 'CMS Topics/Links details processed successfully');
			} catch (\Exception $e) {
				//dd($e);
				return back()->with('error', $e->getMessage());
			}
			@unlink($path);
		}
		return view('admin.cmslinks.import');
	}

	function deleteAll(Request $request)
	{
		CmsLink::whereIn('id', explode(",", $request->ids))->delete();
		return response()->json(['success' => "Deleted successfully."]);
    }
    
    public function getChapter (Request $request)
    {
        $chapters = CmsLink::where('class', $request->class)->where('subject', $request->subject)->groupBy('chapter')->pluck('chapter');

        return Response::json(['success' => true, 'response' => $chapters]);
    }

    public function getTopic (Request $request)
    {
        $topics = CmsLink::where('class', $request->class)->where('subject', $request->subject)
            ->where('chapter', $request->chapter)
            ->groupBy('topic')->pluck('topic');

        return Response::json(['success' => true, 'response' => $topics]);
    }
}
