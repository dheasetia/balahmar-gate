<?php
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
//HOME
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

//test email
//Route::get('/sendAbahEmail', 'MailController@testEmail');
//Route::get('/sendAbahSms', 'MailController@testSMS');
//Route::get('/testToastr', 'MailController@testToastr');
//Route::get('/notification', 'MailController@testNotification');
//Route::get('my_ip', function () {
//    return request()->ip();
//});

//LOGIN
Route::get('/login', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@postLogin');

//REGISTRATION
Route::get('/register', 'RegistrationController@register')->name('register');
Route::post('/register', 'RegistrationController@postRegister');
Route::get('/activation', 'RegistrationController@getActivate');
Route::post('/activation', 'RegistrationController@postActivate');
Route::get('password/forget', 'RegistrationController@forget_password');
Route::post('password/forget', 'RegistrationController@check_forgotten_email');
Route::get('password/reset', 'RegistrationController@reset_password');
Route::post('password/reset', 'RegistrationController@post_reset_password');

Route::group(['middleware' => 'user'], function (){
    //USER
    Route::get('/user/edit', 'UserController@edit');
    Route::post('/user', 'UserController@update');
    Route::get('/user/need_activation', 'UserController@needActivation');
    Route::post('/user/need_activation', 'UserController@sendActivation');

    Route::get('/registered', 'UserController@registered');
    Route::get('/banned', 'UserController@banned');

    //UPDATE PASSWORD
    Route::post('password/update', 'UserController@update_password');

    //OFFICE
    Route::get('/office', 'OfficeController@show');
    Route::post('/office', 'OfficeController@store');
    Route::get('/office/create', 'OfficeController@create');
    Route::get('/office/edit', 'OfficeController@edit');
    Route::patch('/office', 'OfficeController@update');

    //PROPOSALS
    //Route::resource('/proposals', 'ProposalController'); //poposal in singular word because routes error

    //PROJECTS
    Route::get('projects', 'ProjectController@index');
    Route::get('projects/create', 'ProjectController@create');
    Route::post('projects', 'ProjectController@store');
    Route::patch('projects/{id}', 'ProjectController@update');
    Route::get('projects/{id}', 'ProjectController@show');
    Route::get('projects/{id}/edit', 'ProjectController@edit');
    Route::get('projects/{id}/reports/create', 'ProjectController@reports_create');
    Route::get('projects/{id}/reports', 'ProjectController@reports_index');
    Route::post('projects/{id}/reports', 'ProjectController@reports_store');
    Route::get('projects/{id}/receipts/create', 'ProjectController@receipt_create');
    Route::post('projects/{id}/receipts', 'ProjectController@receipt_store');

    //REPORTS
    Route::get('/reports', 'ReportController@index');
    Route::post('/reports', 'ReportController@store');
    Route::get('/reports/picture', 'ReportController@upload_picture');
    Route::post('/reports/picture', 'ReportController@store_picture');
    Route::get('/reports/create', 'ReportController@create');
    Route::get('/reports/{id}', 'ReportController@show');
    Route::patch('/reports/{id}', 'ReportController@update');
    Route::get('/reports/{id}/edit', 'ReportController@edit');

    //ANNOUNCEMENTS
    Route::get('/announcements', 'AnnouncementController@index');
    Route::get('/announcements/unread', 'AnnouncementController@unread');
    Route::get('/announcements/{id}', 'AnnouncementController@show');
    Route::get('/announcements/{id}/favourite', 'AnnouncementController@favourite');

    //MESSAGES
    Route::get('/messages', 'MessageController@index');
    Route::get('/messages/create', 'MessageController@create');
    Route::post('/messages', 'MessageController@store');
    Route::get('/messages/{id}', 'MessageController@show');
    Route::get('/messages/{id}/recipients', 'MessageController@recipients');

    //RECEIPTS
    Route::get('receipts/{id}', 'ReceiptController@show');

    //PICTURES
    Route::post('/pictures', 'PictureController@store');

    //TRACKINGS
    Route::get('tracking', 'TrackingController@index');

    //QUESTIONNARIE
    Route::get('questionnaire', 'QuestionnaireController@show_question_form');
    Route::get('questionnaire/result', 'QuestionnaireController@show_result');
});

//A D M I N
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

    //USERS
    Route::get('/', 'AdminController@index');
    Route::get('users', 'AdminUserController@index');
    Route::post('users', 'AdminUserController@store');
    Route::post('users/assign', 'AdminUserController@assign');
    Route::get('users/{user}/edit', 'AdminUserController@edit');
    Route::get('users/{user}', 'AdminUserController@show');
    Route::patch('users/{user}', 'AdminUserController@update');
    Route::delete('users/{user}', 'AdminUserController@destroy');

    Route::get('groups', 'AdminGroupController@index');
    Route::post('groups', 'AdminGroupController@store');
    Route::get('groups/{id}', 'AdminGroupController@show');
    Route::get('groups/{id}/edit', 'AdminGroupController@edit');
    Route::patch('groups/{id}', 'AdminGroupController@update');
    Route::delete('groups/{id}', 'AdminGroupController@destroy');

    //OFFICES
    //all offices
    Route::get('offices', 'AdminOfficeController@index');
    Route::post('/offices/approve', 'AdminOfficeController@approve');
    Route::post('/offices/unapprove', 'AdminOfficeController@unapprove');
    Route::get('/offices/approved', 'AdminOfficeController@getApprovedOffices');
    Route::get('/offices/unapproved', 'AdminOfficeController@getUnapprovedOffices');
    Route::get('/offices/banned', 'AdminOfficeController@getBannedOffices');
    Route::get('/offices/suspended', 'AdminOfficeController@getSuspendedOffices');
    Route::post('/offices/ban', 'AdminOfficeController@ban');
    Route::post('/offices/suspend', 'AdminOfficeController@suspend');
    Route::post('/offices/unsuspend', 'AdminOfficeController@unsuspend');
    Route::get('/offices/{id}', 'AdminOfficeController@show');
    Route::delete('/offices/{id}', 'AdminOfficeController@destroy');
    Route::get('/offices/{id}/projects', 'AdminOfficeController@projects');

    //my office
    Route::get('office', 'AdminOfficeController@showMyOffice');
    Route::get('office/edit', 'AdminOfficeController@editMyOffice');
    Route::patch('office', 'AdminOfficeController@updateMyOffice');


    //PROJECTS
    Route::get('/projects', 'AdminProjectController@index');
    Route::post('/projects/approve', 'AdminProjectController@approve');
    Route::get('/projects/unapproved/print', 'AdminProjectController@printUnapprovedProjects');
    Route::get('/projects/unapproved', 'AdminProjectController@getUnapprovedProjects');
    Route::get('/projects/approved', 'AdminProjectController@getApprovedProjects');
    Route::get('/projects/banned', 'AdminProjectController@getBannedProjects');
    Route::get('/projects/postponed', 'AdminProjectController@getPostPonedProjects');
    Route::get('/projects/requested', 'AdminProjectController@getRequestedProjects');
    Route::get('/projects/{id}', 'AdminProjectController@show');
    Route::get('/projects/{id}/reports', 'AdminProjectController@report_index');

    //REPORTS
    Route::get('/reports', 'AdminReportController@index');
    Route::get('/reports/{id}', 'AdminReportController@show');

    //RECEIPTS
    Route::get('receipts/{id}', 'AdminReceiptController@show');

    //ANNOUNCEMENTS
    Route::get('/announcements', 'AdminAnnouncementController@index');
    Route::get('/announcements/create', 'AdminAnnouncementController@create');
    Route::post('/announcements', 'AdminAnnouncementController@store');
    Route::get('/announcements/{id}', 'AdminAnnouncementController@show');
    Route::get('/announcements/{id}/edit', 'AdminAnnouncementController@edit');
    Route::patch('/announcements/{id}', 'AdminAnnouncementController@update');

    //MESSAGES
    Route::get('/messages', 'AdminMessageController@index');
    Route::get('/messages/create', 'AdminMessageController@create');
    Route::post('/messages', 'AdminMessageController@store');
    Route::get('/messages/{id}', 'AdminMessageController@show');
    Route::get('/messages/{id}/recipients', 'AdminMessageController@recipients');

    //SMS
    Route::get('/sms', 'AdminSmsController@index');
    Route::post('/sms', 'AdminSmsController@store');
    Route::get('/sms/create', 'AdminSmsController@create');
    Route::get('/sms/{id}', 'AdminSmsController@show');
    Route::get('/sms/{id}/recipients', 'AdminSmsController@recipients');

    //API
    Route::post('api/projects/approved', 'ApiController@load_approved_projects');
    Route::post('api/projects/waiting', 'ApiController@load_waiting_projects');
    Route::post('api/projects/denied', 'ApiController@load_denied_projects');
    Route::get('api/reports/officecountbycity', 'ApiController@office_count_by_city');
    Route::get('api/reports/donationbymonthcurrentyear', 'ApiController@donation_by_month_this_year');
    Route::get('api/office/updatecount', 'ApiController@get_unapproved_office_count');



});


// A P I  general
Route::group(['prefix' => 'abahapi'], function() {
    Route::get('offices/fetch/{iban}', 'ApiController@fetch_office');
    Route::get('offices/{iban}/setbalahmarid', 'ApiController@set_balahmar_office_id');
    Route::get('projects/fetch/{id}', 'ApiController@fetch_project');
    Route::get('projects/{id}/setbalahmarid', 'ApiController@set_balahmar_project_id');
    Route::post('setquestionnaire', 'ApiController@answer_questionnaire');
    Route::post('setquestionnairedescription', 'ApiController@answer_questionnaire_description');

});


Route::post('/logout', 'LoginController@logout')->name('logout');
