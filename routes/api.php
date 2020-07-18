<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/* 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::post('/teacher-login', 'Api\TeacherLoginController@teacher_login_get');

Route::post('deploy', 'DeployController@deploy');
Route::get('setupNewDeploymentJson','DeployController@createJsonFilesForGoogleAuth');

Route::post('/test','TestController@test');

Route::group(['middleware' => 'CheckUserToken'], function(){

	Route::post('/teacher-dashboard', 'Api\TeacherLoginController@teacherDashboard');   // teacher id Required for ALL live/past/assgned class

	Route::post('/teacher-liveClass', 'Api\TeacherLoginController@teacherLiveClass');   // teacher id Required for Live Class
	Route::post('/teacher-pastClass', 'Api\TeacherLoginController@teacherPastClass');   // teacher id Required for past class
	Route::post('/teacher-assignedClass', 'Api\TeacherLoginController@teacherAssignedClass');   // teacher id Required for Assigned class


	Route::post('/get-assignment', 'Api\CommonController@getClasswiseAssignment'); // dateClass Id Required
	Route::post('/get-assignedClassData', 'Api\CommonController@fill_dropDown'); // teacher id Required
	Route::post('/get-subject', 'Api\CommonController@get_subject'); // Get All Subject
	Route::post('/get-cmsLink', 'Api\CommonController@get_cmsLink'); // ClassName and subject id Required
	Route::post('/Update-classTopic', 'Api\CommonController@classTopicUpdate'); // Topic ID and DateClass id Required

	Route::post('/addClass', 'Api\CommonController@addClass'); // date,startTime,endTime, ClassID, TeacherID,Notify student Message Required
	Route::post('/editLiveClass', 'Api\CommonController@editLiveClass'); // DateClassID, TeacherID,Notify student Message and Class Description(class Notes) Required
	Route::post('/editPastClass', 'Api\CommonController@editPastClass'); // DateClassID, TeacherID, Recording URL and Class Description(class Notes) Required
	Route::post('/HelpTicket', 'Api\CommonController@generateHelpTicket'); // DateClassID and TeacherID Required
	Route::post('/General-HelpTicket', 'Api\CommonController@genericHelpTicket'); //  TeacherID and Description Required
	Route::post('/update-classNotes', 'Api\CommonController@UpdateClassNotes'); //  TeacherID and Description Required
	// Test Required
	Route::post('/getAssignment', 'Api\CommonController@getAssignment'); //  TeacherID Required
	Route::post('/notifyStudents', 'Api\CommonController@notifyStudents'); //  TeacherID, DateClassID Required
	Route::post('/getAll-cmsLink', 'Api\CommonController@getAll_cmsLink'); 

	Route::post('/CreateAssignment', 'Api\CommonController@CreateAssignment');  //"teacher_id, txt_topic_name, sel_topic_name, assignment_title, dateClass_id Required.


	Route::post('/GetAssignmentByClass', 'Api\CommonController@GetAssignmentByClass');   //TeacherID, ClassID, SubjectID Required. 

	Route::post('/GetTopicByClass', 'Api\CommonController@GetTopicByClass');    //TeacherID, ClassID Required.
	Route::post('/GiveAssignmentFromCreated', 'Api\CommonController@GiveAssignmentFromCreated'); // Teacher_id, dateClass_id, classwork_id Required.



   Route::post('/details', 'Api\TeacherLoginController@details');
});

