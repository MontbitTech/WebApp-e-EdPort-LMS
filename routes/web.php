<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* for testing   */
/* Route::get('/dashboard','GtestController@index')->name('dashboard');

Route::get('/gtest','GtestController@create_class')->name('gtest');
Route::get('/set_course','GtestController@set_course')->name('set_course');

Route::get('/get_course','GtestController@get_course')->name('get_course');
Route::get('/create_teacher','GtestController@create_teacher')->name('create_teacher');
Route::get('/user_permission/{id}','GtestController@test_user_permission');
Route::get('/create_user','GtestController@create_user'); */

Route::get('/timeTable/{class}/{section}', 'GtestController@TestFilterTimetable');
Route::get('/test_email_timetable', 'GtestController@send_email_timeTable');
Route::get('/get_token', 'GtestController@get_token')->name('get_token');
Route::get('/test', 'TestController@test');


// ------ //

/*  Admin  */
Route::group(['middleware' => 'AuthCheck'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::post('/admin/login', 'AdminController@admin_login_post')->name('admin.login.post');
    Route::get('/admin/login', 'AdminController@admin_login_get')->name('admin.login');
});


Route::group(['middleware' => 'adminsession'], function () {
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

    Route::post('/admin/school-logo', 'AdminController@updateSchoolLogo')->name('admin.school_logo');

    Route::match(array('GET', 'POST'), '/admin/list-setting', 'AdminController@listSetting')->name('admin.settings');
    //Route::match(array('GET','POST'),'/admin/add-setting','AdminController@addSetting')->name('setting.add');
    Route::match(array('GET', 'POST'), '/admin/edit-setting/{id}', 'AdminController@editSetting')->name('setting.edit');
    Route::match(array('GET', 'POST'), '/admin/delete-setting', 'AdminController@deleteSetting')->name('setting.delete');

    Route::get('/admin/downloadPDF', 'GtestController@downloadPDF')->name('admin.downloadPDF');

    Route::get('/admin/dashboard', 'AdminController@adminDashboard')->name('admin.dashboard');

    Route::match(array('GET', 'POST'), '/admin/add-teacher', 'TeacherController@addTeacher')->name('teacher.add');
    Route::match(array('GET', 'POST'), '/admin/edit-teacher/{id}', 'TeacherController@editTeacher')->name('teacher.edit');
    Route::get('/admin/delete-teacher/{id}', 'TeacherController@deleteTeacher')->name('teacher.delete');

    Route::match(array('GET', 'POST'), '/teacher-import', 'TeacherController@importClassTeacher')->name('admin.teacherimport');
    Route::get('/download-teacher', 'TeacherController@sampleTeacherDownload')->name('admin.sampleTeacherDownload');
    /* on going class */
    Route::get('admin/ongoingclass', 'OngoingClassController@index')->name('ongoing.index');

    /* csv uploads */
    Route::get('admin/csv-uploads', 'EventDetailController@index')->name('csvuploads.index');

    /* Reports */
    Route::get('admin/reports', 'AdminController@reports')->name('reports.index');

    /*Support Help*/

    Route::get('/admin/support-help', 'HelpController@helpList')->name('admin.helplist');
    Route::get('/admin/show-helpTicket', 'HelpController@showHelpTicktet')->name('admin.show.helpTicket');
    Route::post('/update-help-status', 'HelpController@updateStatus')->name('helpStatus.update');
    Route::post('filter-ticket', 'HelpController@filterTicket')->name('filter-ticket');

    Route::get('/admin/help-category', 'HelpTicketCategoryController@index')->name('admin.help-category');
    Route::get('/admin/help-category-add', 'HelpTicketCategoryController@add')->name('admin.help-category-add');
    Route::post('/admin/help-category-store', 'HelpTicketCategoryController@store')->name('admin.help-category-store');
    Route::get('/admin/help-category-edit/{id}', 'HelpTicketCategoryController@edit')->name('admin.help-category-edit');
    Route::post('/admin/help-category-update/{id}', 'HelpTicketCategoryController@update')->name('admin.help-category-update');
    Route::get('/admin/help-category-delete/{id}', 'HelpTicketCategoryController@delete')->name('admin.help-category-delete');

    Route::get('/admin/list-timetable', 'ImportTimetableController@listTimetable')->name('list.timetable');
    Route::post('/admin/filter-timetable', 'ImportTimetableController@filterTimetable')->name('list.filtertimetable');
    Route::match(array('GET', 'POST'), '/admin/admin_profile', 'AdminController@adminProfile')->name('admin.profile');

    Route::get('/admin/classes', 'ClassController@list_class')->name('admin.listClass');
    Route::match(array('GET', 'POST'), '/admin/create-classes', 'ClassController@addClasses')->name('classes.add');
    //Route::match(array('GET','POST'),'/admin/edit-classes/{id}','ClassController@editClasses')->name('classes.edit');
    Route::match(array('GET', 'POST'), '/admin/delete-classes', 'ClassController@deleteClasses')->name('classes.delete');
    Route::get('/class-import', function () {
        return view('admin.class.import');
    })->name('admin.class.import');
    Route::post('/class-import', 'ClassController@importClassroom')->name('admin.class.import');
    Route::get('/classroom-import-sample', 'ClassController@sampleClassroomImportFile')->name('admin.sampleClassroomDownload');


    Route::match(array('GET', 'POST'), '/add-extraclass', 'ImportTimetableController@addExtraClass')->name('add.extracalss');

    Route::get('/list-timetable', 'ImportTimetableController@listTimetable')->name('list.timetable');
    Route::post('/edit-timetable', 'ImportTimetableController@editTimetable')->name('timetable.edit');
    Route::match(array('GET', 'POST'), '/timetable-import', 'ImportTimetableController@timeTableImport')->name('admin.timetableimport');
    Route::get('/download-sample', 'ImportTimetableController@sampleDownload')->name('admin.sampleDownload');
    Route::get('timetable/delete/{id}', 'ImportTimetableController@deleteTimetable')->name('timetable-delete');
    Route::post('timetable/deleteAll', 'ImportTimetableController@deleteAllTimetable')->name('timetable-deleteAll');

    Route::get('/admin/list-students', 'ImportStudentsController@listStudents')->name('adminlist.students');
    Route::get('/list-students', 'ImportStudentsController@listStudents')->name('list.students');
    Route::match(array('GET', 'POST'), '/admin/edit-student/{id}', 'ImportStudentsController@editStudent')->name('student.edit');
    Route::match(array('GET', 'POST'), '/admin/add-student', 'ImportStudentsController@addStudent')->name('student.add');
    Route::post('/admin/delete-student/{id}', 'ImportStudentsController@deleteStudent')->name('student.delete');

    Route::match(array('GET', 'POST'), '/students-import', 'ImportStudentsController@importClassStudentNumber')->name('admin.studentsimport');
    Route::get('/download-students', 'ImportStudentsController@sampleStudentsDownload')->name('admin.sampleStudentsDownload');
    Route::delete('admin/deleteAllStudent', 'ImportStudentsController@deleteAllStudent');

    Route::get('/admin/list-topics', 'ImportCMSLinksController@listTopics')->name('admincms.listtopics');
    Route::get('/list-topics', 'ImportCMSLinksController@listTopics')->name('cms.listtopics');
    Route::match(array('GET', 'POST'), '/admin/edit-link/{id}', 'ImportCMSLinksController@editLink')->name('cms.editlink');
    Route::match(array('GET', 'POST'), '/admin/add-link', 'ImportCMSLinksController@addLink')->name('cms.addlink');
    Route::post('/admin/delete-link/{id}', 'ImportCMSLinksController@deleteLink')->name('cms.deletelink');
    Route::post('filter-record', 'ImportCMSLinksController@filterRecord')->name('filter-record');
    Route::delete('admin/cmsDeleteAll', 'ImportCMSLinksController@deleteAll');

    Route::match(array('GET', 'POST'), '/cmslinks-import', 'ImportCMSLinksController@cmsLinksImport')->name('cms.cmslinksimport');
    Route::get('/download-cmslinkssample', 'ImportCMSLinksController@sampleCMSLinksDownload')->name('cms.sampleCMSLinksDownload');
    Route::post('filter-subject', 'ClassController@filterSubject')->name('filter-subject');
    Route::post('filter-student', 'ImportStudentsController@filterStudent')->name('filter-student');
    Route::post('/available/teacher', 'AvailabilityController@availableTeacherAndSubject');

    Route::get('/admin/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/deleteAllClassrooms', 'TestController@deleteAllClassroomsFromGoogle');
    Route::get('/listGoogleClassrooms', 'TestController@listGoogleClassrooms');
    Route::get('/admin/weekleyEmails', 'UtilityController@weekleyMailsToStudents');
    Route::get('admin/video', 'SupportVideoController@index')->name('video');
    Route::get('admin/video/add', function () {
        return view('admin.video.add');
    })->name('video.add');
    Route::post('admin/video/store', 'SupportVideoController@store')->name('video.store');
    // Route::get('admin/video/edit/{id}', 'SupportVideoController@edit')->name('video.edit');
    Route::match(array('GET', 'POST'), 'admin/video/update/{id}', 'SupportVideoController@update')->name('video.update');
    Route::get('admin/video/destroy/{id}', 'SupportVideoController@destroy')->name('video.destroy');
});

/*  Teacher  */
Route::group(['middleware' => 'AuthCheck'], function () {
    Route::get('/teacher', 'TeacherLoginController@index')->name('teacher.index');

    Route::post('/teacher/login', 'TeacherLoginController@teacher_login_post')->name('teacher.login.post');
    Route::get('/teacher/login', 'TeacherLoginController@teacher_login_get')->name('teacher.login');
});
Route::group(['middleware' => 'teachersession'], function () {
    Route::get('/teacher/logout', 'TeacherLoginController@logout')->name('teacher.logout');
    Route::get('/teacher/home', 'TeacherLoginController@teacherDashboard')->name('teacher.dashboard');
    Route::get('/teacher/getStudent', 'TeacherLoginController@getStudent')->name('teacher.student');

    Route::get('get-topic', 'TeacherLoginController@getTopic')->name('get-topic');


    Route::post('/teacher/add-class', 'TeacherClassController@addClass')->name('add.class');
    Route::post('/teacher/edit-live-class', 'TeacherClassController@ajaxSaveLiveClass')->name('edit.class');
    Route::post('/edit-past-class', 'TeacherClassController@ajaxSavePastClass'); //->name('edit.Pastclass');
    Route::get('/teacher/acceptClass', 'TeacherClassController@ajaxAcceptClass')->name('teacher.acceptClass');

    Route::get('/test_email', 'TeacherClassController@html_email'); //->name('teacher.acceptClass');

    Route::get('/teacher/quiz', 'QuizController@index')->name('teacher.quiz');

    Route::get('/teacher/assignment', 'ClassWorkController@index')->name('teacher.assignment');
    Route::post('/create-assignment', 'ClassWorkController@ajaxCreateAssignment');

    Route::post('/get-links', 'ClassWorkController@ajaxLinks');
    Route::post('/get-topics', 'ClassWorkController@ajaxTopics');
    Route::post('/get-subjects', 'ClassWorkController@ajaxSubjects');
    Route::post('/get-assignment', 'ClassWorkController@ajaxGetAssignment');
    Route::post('/give-assignment', 'ClassWorkController@ajaxGiveAssignment');

    Route::get('/test_email', 'TeacherClassController@html_email'); //->name('teacher.acceptClass');

    Route::get('/teacher/report', 'ReportController@teacherReport')->name('teacher.report');
    Route::match(array('GET', 'POST'), '/student-notify', 'TeacherClassController@notifyStudents')->name('student-notify');

    Route::post('/generate-help-ticket', 'HelpController@generateHelpTicket')->name('teacher.generate_ticket');
    Route::post('/generate-Ghelp', 'HelpController@genericHelpTicket')->name('generate-Ghelp');

    Route::post('/update-profile-picture', 'HomeController@updateProfilePicture')->name('teacher.profile_picture');
    Route::post('/update-name', 'HomeController@updateName')->name('teacher.name');

    Route::post('/class-topic-update', 'ClassWorkController@classTopicUpdate')->name('classtopic.update');
    Route::post('/update-classNotes', 'ClassWorkController@ajaxUpdateClassNotes')->name('update-classNotes');

    Route::post('/available/classes', 'AvailabilityController@availableClasses');
    Route::post('/teacher/class/assignments', 'ClassWorkController@getClassAssignments');
    Route::post('/teacher/class/examassignments', 'ClassWorkController@getExamAssignments');
    Route::get('/teacher/class/viewPastClass', 'TeacherLoginController@viewPastClass');
    Route::get('/teacher/class/viewFutureClass', 'TeacherLoginController@viewFutureClass');

    //Route::post('/generate-help-ticket', 'HelpController@generateHelpTicket')->name('teacher.generate_ticket');

    Route::post('/teacher/Attendance', 'StudentAttendanceController@store')->name('save.attendance');
    Route::get('/teacher/Attendance', 'StudentAttendanceController@index')->name('get.attendance');
    Route::post('/teacher/updateAttendance', 'StudentAttendanceController@update');

    Route::get('/teacher/generateReports', 'ReportController@assignmentSubmissionGrades');
    Route::get('/getChapter', 'ImportCMSLinksController@getChapter');
    Route::get('/getTopic', 'ImportCMSLinksController@getTopic');

    // Examination

    Route::get('/teacher/examination', 'Examination\ExaminationController@createExamination')->name('examination');
    //    Route::get('/teacher/examination/back', 'Examination\ExaminationController@createExamination')->name('examination');
    Route::post('/teacher/setExamination', 'Examination\ExaminationController@setExamination');
    Route::post('/teacher/examination/exampaper', 'Examination\ExaminationController@getExamination');
    Route::post('/teacher/assign-examination', 'Examination\ExaminationController@assignExamination');
    Route::post('/teacher/examination/exampaperlist', 'Examination\ExaminationController@getExaminationList');
    Route::post('/teacher/examination/examdelete/{id}', 'Examination\ExaminationController@examDelete')->name('examination.delete');
    Route::post('/examination/create', 'Examination\ExaminationController@store');
    Route::get('/getQuestions', 'Examination\QuestionController@index');
    Route::post('/saveQuestion', 'Examination\QuestionController@store');
    Route::post('/deleteQuestion/{id}', 'Examination\QuestionController@destroy');
    Route::get('/teacher/examination/getExamsList', 'Examination\ExaminationController@getExaminationList');
    Route::get('/teacher/examination/resultList', 'Examination\ExaminationResultController@get');
});

//Route::get('/student/takeExam/{id}', 'Examination\ExaminationController@takeExamination');
Route::post('/student/validateStudent', 'Examination\ExaminationController@validateStudent');
Route::post('/student/saveExamLogs', 'Examination\ExaminationLogsController@saveExamLogs');
Route::get('/addData_pastClass', 'ClassWorkController@addData_DateClass')->name('reload-timetable');
Route::get('/timeTable/{class}/{section}', 'ImportTimetableController@download_Timetable');
//Reload Timetable URL - http://<domain>/addData_pastClass


//  **************** student examination  ************
Route::get('/student/exam', function () {
    return view('examination.exam');
})->name('student.exam');
Route::get('/student/result', function () {
    return view('examination.result');
})->name('student.result');
//*********************************
// *********** Student ************
// **********************************


Route::get('/student', 'Student\LoginController@index')->name('student.index');

Route::post('/student/login', 'Student\LoginController@studentLoginPost')->name('student.login.post');
Route::get('/student/login', 'Student\LoginController@studentLoginGet')->name('student.login');

Route::group(['middleware' => 'studentsession'], function () {
});
// Dashboard
Route::get('student/dashboard', 'Student\DashboardController@index')->name('student.dashboard');
// Lecture
Route::get('student/lecture', 'Student\LectureController@index')->name('student.lecture');
// Examination
Route::get('student/examination', 'Student\ExaminationController@index')->name('student.examination');
Route::get('/student/examination/performance', 'Student\ExaminationController@performance')->name('student.performance');
// Profile
Route::get('student/profile', 'Student\ProfileController@index')->name('student.profile');
// Register
Route::get('student/register', 'Student\RegisterController@index')->name('student.register');
