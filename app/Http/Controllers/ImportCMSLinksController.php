<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\Teacher;
use App\CmsLink;
use App\StudentClass;
use App\StudentSubject;
use App\ClassTiming;
use App\InvitationClass;
use App\Models\ClassSection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Helpers\CustomHelper;

class ImportCMSLinksController extends Controller
{
    public function addLink(Request $request)
    {
	    $error = "";
        if($request->isMethod('post')) 
		 {
		  $regex  = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)([\/\w \.?]*)([\/\w \.=]*)*\/?$/';

            $request->validate([ 
              'subject' => 'required',
              'class'   => 'required',
              'topic'   => 'required',
	          'link'    => 'required_without_all:khan_academy,youtube,others,alink|nullable|regex:'.$regex,
			  'khan_academy' => 'required_without_all:link,youtube,others,alink|nullable|regex:'.$regex,
			  'youtube'   => 'required_without_all:khan_academy,link,others,alink|nullable|regex:'.$regex,
		      'others'  => 'required_without_all:khan_academy,link,youtube,alink|nullable|regex:'.$regex,
			  'alink'   => 'required_without_all:khan_academy,link,youtube,others|nullable|regex:'.$regex
            ]);
			
			$studentClassExist=\DB::select('select id from tbl_cmslinks where class=? and subject=? and topic=? and link=? and assignment_link=?',
						[$request["class"], $request["subject"], $request["topic"], $request["link"], $request["alink"], ]);				
			
			if($studentClassExist)
			{
				Log::error('Link already exists : ROW - ' . $i);
				$error = "found";
			}
			else
				$s = \DB::table('tbl_cmslinks')->insert(
									['class' => $request["class"], 'subject' => $request["subject"], 'topic' => $request["topic"],'link' => $request["link"], 'khan_academy' => $request["khan_academy"], 'youtube' => $request["youtube"], 'others' => $request["others"],'assignment_link'=> $request["alink"]]
								);
			
			if($error == "found")
				return redirect()->route('cms.listtopics')->with('error','CMS Topics/Links processed, check log file for errors!!');
			else
				return redirect()->route('cms.listtopics')->with('success','CMS Topics/Links details processed successfully');
		}
		
		$subjects = \DB::table('tbl_student_subjects')->get();
		$data['class'] = \DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name','class_name');
		$data['class']->prepend('Select Class','');
		
		return view('admin.cmslinks.add',compact('subjects','data'));
    }
     public function editLink (Request $request, $id)
    {
	    # $regex  = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';  
		$regex  = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)([\/\w \.?]*)([\/\w \.=]*)*\/?$/';

	   if($request->isMethod('post')) 
		{
            $request->validate([ 
            'subject' => 'required|max:100',
            'class' => 'required',
            'topic' => 'required',
			'link' => 'required_without_all:khan_academy,youtube,others,alink|nullable|regex:'.$regex,
			'khan_academy' => 'required_without_all:link,youtube,others,alink|nullable|regex:'.$regex,
			'youtube'      => 'required_without_all:khan_academy,link,others,alink|nullable|regex:'.$regex,
		     'others'       => 'required_without_all:khan_academy,link,youtube,alink|nullable|regex:'.$regex,
			  'alink'  => 'required_without_all:khan_academy,link,youtube,others|nullable|regex:'.$regex
            ]);
			
			$id = decrypt($id);
			
			$s = \DB::table('tbl_cmslinks')->where('id',$id)->update(
					['class' => $request["class"], 'subject' => $request["subject"], 'topic' => $request["topic"],'link' => $request["link"],
					'youtube' => $request["youtube"],'khan_academy' => $request["khan_academy"],'others' => $request["others"],'assignment_link'=> $request["alink"]]
			);
			
			return redirect()->route('cms.listtopics')->with('success',Config::get('constants.WebMessageCode.112'));
	    }
		
        $id = decrypt($id); 

        $link = \DB::select('select * from tbl_cmslinks where id=?',[$id]);
		$subjects = \DB::table('tbl_student_subjects')->get();
		$data['class'] = \DB::table('tbl_classes')->select('class_name')->distinct()->get()->pluck('class_name','class_name');
		$data['class']->prepend('Select Class','');
        return view('admin.cmslinks.edit',compact('link','subjects','data'));
    }
	
    public function deleteLink (Request $request,$id)
    {	
		 $sid = decrypt($id); 
		//dd($sid);
		$student = \DB::table('tbl_cmslinks')->where('id',$sid)->delete();
			
		$lists = \DB::select('select c.id, c.class, c.subject, s.subject_name, c.topic, c.link from tbl_cmslinks c, tbl_student_subjects s where c.subject = s.id');

		return redirect()->route('cms.listtopics')->with('success','Deleted Successfully');
    } 
	
	
     public function listTopics()
    {
    	$cms      = CmsLink::get();
        $classes  = ClassSection::select('class_name')->distinct()->get();
		$subjects = StudentSubject::get();
        return view('admin.cmslinks.index',compact('classes','subjects','cms'));
    }

    public function filterRecord(Request $request, CmsLink $cmslink)
    {
    	$rec = $cmslink->newQuery();
    	if(!empty($request->txtSerachClass)){
    		$getResult = $rec->where('class', $request->txtSerachClass)->get();
    		if(!empty($request->txtSerachSubject )){
    			$getResult = $rec->where('subject', $request->txtSerachSubject)->get();
    		}
    	}

	    return view('admin.cmslinks.filter-record',compact('getResult'));
    }

	public function sampleCMSLinksDownload(Request $request)
	{
		$path = public_path('cms-excels/sample/').'/ClassSubjectTopicUrl.csv';
		
        return response()->download($path);
	}
	
	
    /*Import no of students in a class*/
    public function cmsLinksImport(Request $request){
       // $student_class = \App\StudentClass::all();
		$error = "";
        if(Request()->post()){
        	$request->validate([
                    'file' => 'required'
                 //   'class' => 'required'
                ]);
            try{
				
                $extensions = array("csv","xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());
				$rows = "";

                if (!in_array($file_validate, $extensions)) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }
				
                $file = $request->file('file');
                $destinationPath = public_path('cms-excels');
				
                $filename = $file->getClientOriginalName();
				
				if(file_exists($destinationPath.'/'.$filename))
					unlink($destinationPath.'/'.$filename);
		
                $file->move($destinationPath,$filename);
				
                $path = $destinationPath.'/'.$filename;

                $headerMissing = array();
                $supplierAdded = 0;
                $i = 1;
                $collection = (new FastExcel)->import($path);

					if(!isset($collection[0])){
						return back()->with('error',Config::get('constants.WebMessageCode.104'));
					}
					 $numbers = array();
					 
					Log::info('Filename processing - ' . $filename);
					
					
					foreach($collection as $key => $reader)
					{
						
						$class = \DB::table('tbl_classes')->select('class_name')->where('class_name', $reader["class"])->get();
						$subjects = \DB::table('tbl_student_subjects')->where('subject_name',$reader["subject"])->get();

						
						if($reader["class"] == "" || $reader["subject"] == "" || $reader["topic"] == "")
						{
							Log::error('CMS details missing : ROW - ' . $i);
							$error = "found";
							$rows .= $i . ",";
						}
						elseif(!empty($reader["class"]) && count($class) == 0)
						{
							Log::error('Invalid Class name : ROW - ' . $i);
							$error = "found";
							$rows .= $i . ",";
						}
						elseif(!empty($reader["subject"]) && $subjects->count() == 0)
						{
							Log::error('Invalid subject name : ROW - ' . $i);
							$error = "found";
							$rows .= $i . ",";
						}
						elseif(!empty($reader["link"]) && !CustomHelper::is_url( $reader['link'] ))
						{
							Log::error('Invalid Link url : ROW - ' . $i);
							$error = "found";
							$rows .= $i . ",";
						}
						elseif(!empty($reader["youtube"]) && !CustomHelper::is_url( $reader['youtube'] ))	
						{	
							Log::error('Invalid Link url : ROW - ' . $i);	
							$error = "found";	
							$rows .= $i . ",";	
						}	
						elseif(!empty($reader["khan_academy"]) && !CustomHelper::is_url( $reader['khan_academy'] ))	
						{	
							Log::error('Invalid Link url : ROW - ' . $i);	
							$error = "found";	
							$rows .= $i . ",";	
						}	
						elseif(!empty($reader["others"]) && !CustomHelper::is_url( $reader['others'] ))	
						{	
							Log::error('Invalid Link url : ROW - ' . $i);	
							$error = "found";	
							$rows .= $i . ",";	
						}
						elseif(!empty($reader["assignment"]) && !CustomHelper::is_url( $reader['assignment'] ))
						{
							Log::error('Invalid Assignment url : ROW - ' . $i);
							$error = "found";
							$rows .= $i . ",";
						}
						elseif(empty($reader["link"]) && empty($reader["youtube"]) && empty($reader["khan_academy"]) && empty($reader["others"]) && empty($reader["assignment"])){	
                            Log::error('Either one CMS link  should be present : ROW - ' . $i);	
                            $error = "found";	
                            $rows .= $i . ",";	
                        }
						else {
							//$subjects = \DB::table('tbl_student_subjects')->where('subject_name',$reader["subject"])->get();

							if($subjects->count() > 0)
							{
								$studentClassExist=\DB::select('select id from tbl_cmslinks where class="'.$reader["class"].'" and subject="'.$subjects[0]->id.'" and topic="'.$reader["topic"].'" and link="'.$reader["link"].'" and youtube="'.$reader["youtube"].'"and khan_academy="'.$reader["khan_academy"].'"and others="'.$reader["others"].'" and assignment_link="'.$reader["assignment"].'"');
								
								if(count($studentClassExist) > 0)
								{
									Log::error('Link already exists : ROW - ' . $i);
									$error = "found";
									$rows .= $i . ",";
								}
								else
								{
									$s = \DB::table('tbl_cmslinks')->insert(	
								['class' => $reader["class"], 'subject' => $subjects[0]->id, 'topic' => $reader["topic"],'link' => $reader["link"],
								'youtube' => $reader["youtube"],'khan_academy' => $reader["khan_academy"],'others' => $reader["others"],	
								'assignment_link'=>$reader["assignment"]]
									);
								}								
							}
							else
							{
								Log::error('Subject not found : ROW - ' . $i);
								$rows .= $i . ",";
							}
						}
						
						$i += 1;
					}
					
					Log::info('File processing done ');
					
					if($error == "found")
						return back()->with('error','CMS Topics/Links processed, error in ROWS - ' . $rows);
					else
						return back()->with('success','CMS Topics/Links details processed successfully');

                }catch(\Exception $e){
					//dd($e);
                    return back()->with('error',$e->getMessage());
                }
                @unlink($path);
        }
        return view('admin.cmslinks.import');
    }

    function deleteAll(Request $request)
    {
    	CmsLink::whereIn('id',explode(",",$request->ids))->delete();
    	return response()->json(['success'=>"Deleted successfully."]);
    }
}
