<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index');


/* for testing   */
/* Route::get('/dashboard','GtestController@index')->name('dashboard');

Route::get('/gtest','GtestController@create_class')->name('gtest');
Route::get('/set_course','GtestController@set_course')->name('set_course');

Route::get('/get_course','GtestController@get_course')->name('get_course');
Route::get('/create_teacher','GtestController@create_teacher')->name('create_teacher');
Route::get('/user_permission/{id}','GtestController@test_user_permission');
Route::get('/create_user','GtestController@create_user'); */
Route::get('/timeTable/{class}/{section}','GtestController@TestFilterTimetable'); 
Route::get('/test_email_timetable','GtestController@send_email_timeTable'); 
Route::get('/get_token','GtestController@get_token')->name('get_token');

// ------ //

/*  Admin  */
Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::post('/admin/login', 'AdminController@admin_login_post')->name('admin.login.post');
Route::get('/admin/login', 'AdminController@admin_login_get')->name('admin.login');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
Route::post('/admin/school-logo', 'AdminController@updateSchoolLogo')->name('admin.school_logo');

Route::match(array('GET','POST'),'/admin/list-setting','AdminController@listSetting')->name('admin.settings');
//Route::match(array('GET','POST'),'/admin/add-setting','AdminController@addSetting')->name('setting.add');
Route::match(array('GET','POST'),'/admin/edit-setting/{id}','AdminController@editSetting')->name('setting.edit');
Route::match(array('GET','POST'),'/admin/delete-setting','AdminController@deleteSetting')->name('setting.delete');

Route::group(['middleware' => 'adminsession'], function() {


Route::get('/admin/downloadPDF','GtestController@downloadPDF')->name('admin.downloadPDF');

	Route::get('/admin/dashboard','AdminController@adminDashboard')->name('admin.dashboard');
	
	Route::match(array('GET','POST'),'/admin/add-teacher','TeacherController@addTeacher')->name('teacher.add');
	Route::match(array('GET','POST'),'/admin/edit-teacher/{id}','TeacherController@editTeacher')->name('teacher.edit');
	Route::get('/admin/delete-teacher/{id}','TeacherController@deleteTeacher')->name('teacher.delete');
	
	Route::match(array('GET','POST'),'/teacher-import','TeacherController@importClassTeacher')->name('admin.teacherimport');
	Route::get('/download-teacher','TeacherController@sampleTeacherDownload')->name('admin.sampleTeacherDownload');
	
	/*Support Help*/
	
	Route::get('/admin/support-help','HelpController@helpList')->name('admin.helplist');
	Route::post('/update-help-status','HelpController@updateStatus')->name('helpStatus.update');
	
	Route::get('/admin/list-timetable','ImportTimetableController@listTimetable')->name('list.timetable');
	Route::post('/admin/filter-timetable','ImportTimetableController@filterTimetable')->name('list.filtertimetable');
	Route::match(array('GET','POST'),'/admin/admin_profile','AdminController@adminProfile')->name('admin.profile');

	Route::get('/admin/classes','ClassController@list_class')->name('admin.listClass');
	Route::match(array('GET','POST'),'/admin/create-classes','ClassController@addClasses')->name('classes.add');
	//Route::match(array('GET','POST'),'/admin/edit-classes/{id}','ClassController@editClasses')->name('classes.edit');
	Route::match(array('GET','POST'),'/admin/delete-classes','ClassController@deleteClasses')->name('classes.delete');

	Route::match(array('GET','POST'),'/add-extraclass','ImportTimetableController@addExtraClass')->name('add.extracalss');
	
	Route::get('/list-timetable','ImportTimetableController@listTimetable')->name('list.timetable');
	Route::post('/edit-timetable','ImportTimetableController@editTimetable')->name('timetable.edit');
	Route::match(array('GET','POST'),'/timetable-import','ImportTimetableController@timeTableImport')->name('admin.timetableimport');
	Route::get('/download-sample','ImportTimetableController@sampleDownload')->name('admin.sampleDownload');
	
	Route::get('/admin/list-students','ImportStudentsController@listStudents')->name('adminlist.students');
	Route::get('/list-students','ImportStudentsController@listStudents')->name('list.students');
	Route::match(array('GET','POST'),'/admin/edit-student/{id}','ImportStudentsController@editStudent')->name('student.edit');
	Route::match(array('GET','POST'),'/admin/add-student','ImportStudentsController@addStudent')->name('student.add');
	Route::post('/admin/delete-student/{id}','ImportStudentsController@deleteStudent')->name('student.delete');

	Route::match(array('GET','POST'),'/students-import','ImportStudentsController@importClassStudentNumber')->name('admin.studentsimport');
	Route::get('/download-students','ImportStudentsController@sampleStudentsDownload')->name('admin.sampleStudentsDownload');
	
	Route::get('/admin/list-topics','ImportCMSLinksController@listTopics')->name('admincms.listtopics');
	Route::get('/list-topics','ImportCMSLinksController@listTopics')->name('cms.listtopics');
	Route::match(array('GET','POST'),'/admin/edit-link/{id}','ImportCMSLinksController@editLink')->name('cms.editlink');
	Route::match(array('GET','POST'),'/admin/add-link','ImportCMSLinksController@addLink')->name('cms.addlink');
	Route::post('/admin/delete-link/{id}','ImportCMSLinksController@deleteLink')->name('cms.deletelink');

	Route::match(array('GET','POST'),'/cmslinks-import','ImportCMSLinksController@cmsLinksImport')->name('cms.cmslinksimport');
	Route::get('/download-cmslinkssample','ImportCMSLinksController@sampleCMSLinksDownload')->name('cms.sampleCMSLinksDownload');
});


/*  Teacher  */
	Route::get('/teacher', 'TeacherLoginController@index')->name('teacher.index');
	Route::post('/teacher/login','TeacherLoginController@teacher_login_post')->name('teacher.login.post');
	Route::get('/teacher/login','TeacherLoginController@teacher_login_get')->name('teacher.login');
	Route::get('/teacher/logout', 'TeacherLoginController@logout')->name('teacher.logout');

	Route::group(['middleware' => 'teachersession'], function() 
	{
		Route::get('/teacher/home','TeacherLoginController@teacherDashboard')->name('teacher.dashboard'); 

		Route::post('/teacher/add-class', 'TeacherClassController@addClass')->name('add.class');
		Route::post('/teacher/edit-live-class', 'TeacherClassController@ajaxSaveLiveClass')->name('edit.class');
		Route::post('/edit-past-class', 'TeacherClassController@ajaxSavePastClass');//->name('edit.Pastclass');
		Route::get('/teacher/acceptClass', 'TeacherClassController@ajaxAcceptClass')->name('teacher.acceptClass');
		
		Route::get('/test_email', 'TeacherClassController@html_email');//->name('teacher.acceptClass');

		Route::get('/teacher/quiz', 'QuizController@index')->name('teacher.quiz');
		
		Route::get('/teacher/assignment', 'ClassWorkController@index')->name('teacher.assignment');
		Route::post('/create-assignment', 'ClassWorkController@ajaxCreateAssignment');
		
		Route::post('/get-links', 'ClassWorkController@ajaxLinks');
		Route::post('/get-topics', 'ClassWorkController@ajaxTopics');
		Route::post('/get-subjects', 'ClassWorkController@ajaxSubjects');
		Route::post('/get-assignment', 'ClassWorkController@ajaxGetAssignment');
		Route::post('/give-assignment', 'ClassWorkController@ajaxGiveAssignment');
		

		Route::get('/teacher/report', 'ReportController@index')->name('teacher.report'); 
		Route::match(array('GET','POST'),'/student-notify', 'TeacherClassController@notifyStudents')->name('student-notify'); 
			
		Route::post('/generate-help-ticket', 'HelpController@generateHelpTicket')->name('teacher.generate_ticket');
		Route::post('/generate-Ghelp', 'HelpController@genericHelpTicket')->name('generate-Ghelp');
		
		Route::post('/update-profile-picture', 'HomeController@updateProfilePicture')->name('teacher.profile_picture');
		Route::post('/update-name', 'HomeController@updateName')->name('teacher.name');
		
		Route::post('/class-topic-update', 'ClassWorkController@classTopicUpdate')->name('classtopic.update');
		Route::post('/update-classNotes', 'ClassWorkController@ajaxUpdateClassNotes')->name('update-classNotes');
		
		
		//Route::post('/generate-help-ticket', 'HelpController@generateHelpTicket')->name('teacher.generate_ticket');
	});

Route::get('/addData_pastClass','ClassWorkController@addData_DateClass');
Route::get('/timeTable/{class}/{section}','ImportTimetableController@download_Timetable');

//Cron JOb URL  http://290px.com/elearn/public/addData_pastClass



