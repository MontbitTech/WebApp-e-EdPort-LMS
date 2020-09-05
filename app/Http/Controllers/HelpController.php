<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

//use Auth;
use Validator;
use Session;
use App\Teacher;
use App\SupportHelp;
use App\DateClass;
use App\Http\Helpers\CommonHelper;
use App\StudentClass;
use App\StudentSubject;


class HelpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct ()
    {
        //$this->middleware('auth');
        //return Auth::guard('admin');
    }

    /**
     * Listing help.
     *
     * @return list view
     */

    public function helpList (Request $request)
    {
        $categories = HelpTicketCategory::get();
        $helpTickets =  SupportHelp::orderBy('id', 'DESC')->get();
        return view('admin.help.list', compact('categories','helpTickets'));
    }

    public function showHelpTicktet (Request $request)
    {
        $categories = HelpTicketCategory::get();
        $helpTickets =  SupportHelp::orderBy('status', 'DESC')->get();
        return view('admin.help.ajax-help-ticket', compact('categories','helpTickets'));
    }


    public function filterTicket (Request $request)
    {
        $categories = HelpTicketCategory::get();

        $selectedCategory = null;
        if ( isset($request->category) && $request->category != 'all' ) {
            $support_help = SupportHelp::orderBy('status', 'DESC')
                ->where('help_ticket_category_id', $request->category)->get();
            $selectedCategory = $request->category;
        } else {
            SupportHelp::where('read_status', 0)->update(['read_status' => 1]);
            $support_help = SupportHelp::orderBy('status', 'DESC')->get();
        }

        return view('admin.help.filter-ticket', compact('support_help', 'categories', 'selectedCategory'))->with('i', 0);
    }

    public function updateStatus (Request $request)
    {
        $supportHelp = SupportHelp::find($request->help_id);
        $supportHelp->status = $request->status_id;
        if ( $request->status_id == 3 ) {
            $supportHelp->comments = $request->comment . ' ( Closed at :' . date('d/m/Y h:i:sa') . ' )';
            $message = 'Your ticket has been closed. Reason : ' . $supportHelp->comments;
            CommonHelper::send_sms($supportHelp->teacher->phone, $message);
        }

        $supportHelp->save();

        echo json_encode(array('status' => 'success', 'message' => Config::get('constants.WebMessageCode.134')));
    }


    public function generateHelpTicket (Request $request)
    {

        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];
        $logged_teacher_name = $logged_teacher['teacher_name'];
        $logged_teacher_phone = $logged_teacher['teacher_phone'];


        if ( Request()->post() || Request()->ajax() ) {


            //$desc = $request->description;


            /* if($desc == "" ){
                return json_encode(array('status'=>'error', 'message'=>'Description required.' ));
            }
            else if(!preg_match("/^[a-zA-Z0-9 ]*$/", $desc))
            {
                return json_encode(array('status'=>'error', 'message'=> "Description must be letter and numbers."));
            } */


            $support_help = new SupportHelp();

            $support_help->teacher_id = $logged_teacher_id;
            $support_help->description = isset($request->description) ? $request->description : '';
            $support_help->help_type = $request->help_type;
            $support_help->class_id = $request->class_id;
            $support_help->subject_id = $request->subject_id;
            $support_help->read_status = 0;
            $support_help->class_join_link = isset($request->joinlive) ? $request->joinlive : '';
            $support_help->help_ticket_category_id = 1;
            $support_help->save();


            $subject_name = StudentSubject::where('id', $request->subject_id)->get();
            $sub_name = $subject_name[0]['subject_name'];

            $class_name = StudentClass::where('id', $request->class_id)->get();
            $cls_name = $class_name[0]['class_name'];
            $section_name = $class_name[0]['section_name'];

            $support_numbers = CommonHelper::get_support_number();

            $message = "$logged_teacher_name - $logged_teacher_phone have requested support for class : $cls_name - $section_name - $sub_name.";

            $s = CommonHelper::send_sms($support_numbers, $message);


            /* $res = DateClass::find($request->dateClass_id);
            $res->class_description = $request->description;
            $res->save(); */
            
            echo json_encode(array('status' => 'success', 'message' => Config::get('constants.WebMessageCode.111')));
        } else {
            echo json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.121')));
        }

    }

    public function genericHelpTicket (Request $request)
    {
        $logged_teacher = Session::get('teacher_session');
        $logged_teacher_id = $logged_teacher['teacher_id'];

        $logged_teacher_name = $logged_teacher['teacher_name'];
        $logged_teacher_phone = $logged_teacher['teacher_phone'];

        if ( Request()->post() || Request()->ajax() ) {
            $support_help = new SupportHelp;

            $validator = Validator::make($request->all(), [
                'desc'          => 'required',
                'help_category' => 'required',
            ],
                [
                    'desc.required'          => 'Message required',
                    'help_category.required' => 'Category required',
                ]);

            if ( !$validator->passes() ) {
                //return response()->json(['status'=>'error','message'=>]);
                return json_encode(array('status' => 'error', 'message' => $validator->errors()->all()));
            }


            $support_help->teacher_id = $logged_teacher_id;
            $support_help->description = isset($request->desc) ? $request->desc : '';
            $support_help->help_type = $request->help_type;
            $support_help->help_ticket_category_id = isset($request->help_category) ? $request->help_category : null;
            $support_help->read_status = 0;

            $support_help->save();


            $support_numbers = CommonHelper::get_support_number();

            $message = "$logged_teacher_name - $logged_teacher_phone have requested support.";

            $s = CommonHelper::send_sms($support_numbers, $message);

            return json_encode(array('status' => 'success', 'message' => Config::get('constants.WebMessageCode.111')));

        } else {
            return json_encode(array('status' => 'error', 'message' => Config::get('constants.WebMessageCode.121')));
        }

    }
    /*  public function teacherHelpMSG($teacher_id = 0){
          $apiKey     = env( 'TEXTLOCAL_APIKEY' );
          $txt_sender = env( 'TEXTLOCAL_SENDER' );
          $support_number = env( 'SUPPORT_NUMBER' );
          $sender = urlencode($txt_sender);

          $getRow = \App\User::find($teacher_id);
          $name = $getRow->name;
          $email = $getRow->email;

          if($support_number && $email){
              $message = 'Teacher: '. ucwords($name). '('.$email.') need help';

              if(strlen($support_number) <= 10){
                  $number = '91'.$support_number;
              }else{
                  $number = $support_number;
              }

              $data = array('apikey' => $apiKey, 'numbers' => $number, "sender" => $sender, "message" => $message);

              // Send the POST request with cURL
              $ch = curl_init('https://api.textlocal.in/send/');
              curl_setopt($ch, CURLOPT_POST, true);
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($ch);
              curl_close($ch);
              // Process your response here
              $result = json_decode($response);

              if($result->status == 'success'){
                  return true;
              }else{
                  return false;
              }

          }
      } */
}
