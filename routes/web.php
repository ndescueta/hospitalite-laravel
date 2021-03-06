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


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'HomeContentsController@index2');
/* REGISTRATION */
Route::post('/register', 'HospitalController@register');
Route::post('/login', 'HospitalController@login');



Route::group(['middleware' => 'auth:admin'], function()
{
    //DASHBOARD ROUTE
    Route::get('admin/','AdminController@dashboard');

    //TRAININGS AND SEMINARS ROUTE
    Route::get('admin/trainings','TrainingsController@index');
    Route::get('admin/trainings/add','TrainingsController@addEventView');
    Route::get('admin/trainings/edit/{intEventId}','TrainingsController@editEventView');
    Route::get('admin/viewEvent/{intEventId}','TrainingsController@viewEvent');
    Route::post('admin/addEvent','TrainingsController@addEvent');
    Route::post('admin/editEvent','TrainingsController@editEvent');
    Route::post('admin/deleteEvent','TrainingsController@deleteEvent');
    Route::get('admin/test','TrainingsController@test');

    // SERVICES ROUTE
    Route::get('admin/services', 'ServicesController@index');
    Route::get('admin/getModalEditService/{intServiceId}','ServicesController@getModalEditService');
    Route::post('admin/addService','ServicesController@addService');
    Route::post('admin/editService','ServicesController@editService');
    Route::post('admin/deleteService','ServicesController@deleteService');

    //REQUESTS Route
    /*Route::get('admin/hospitalrequest','RequestsController@index');
    Route::get('admin/hospitalrequestShow/{intEventId}','RequestsController@show');*/
    //PARTICIPANTS ROUTE
    Route::resource('admin/hospitalrequest','RequestsController');
    Route::resource('admin/hospitalrequestShow','ParticipantsController');
    Route::post('admin/hospitalrequestShow/storeParticipants','ParticipantsController@store2')->name('hospitalrequestShow.storeParticipants');
    Route::post('/updateRequest','ParticipantsController@updateRequest');
    Route::post('/updatePayment','ParticipantsController@updatePayment');


    //DIRECTORS ROUTE
    Route::get('admin/hospitaldirector','HospitalDirectorsController@index');
    Route::get('admin/getModalEditDirector/{intDirectorId}','HospitalDirectorsController@getModalEditDirector');
    Route::post('admin/addDirector','HospitalDirectorsController@addDirector');
    Route::post('admin/editDirector','HospitalDirectorsController@editDirector');
    Route::post('admin/deleteDirector/{intDirectorId}','HospitalDirectorsController@deleteDirector');

    //HOSPITALS ROUTE
    Route::get('admin/hospital','HospitalsController@index');
    Route::get('admin/getModalEditHospital/{intHospitalId}','HospitalsController@getModalEditHospital');
    Route::post('admin/addHospital','HospitalsController@addHospital');
    Route::post('admin/editHospital','HospitalsController@editHospital');
    Route::post('admin/deleteHospital/{intHospitalId}','HospitalsController@deleteHospital');

    //ADMIN HOMEPAGE ROUTE
    Route::get('admin/homepage','AdminController@homepage');

    //FAQs
    Route::get('admin/faqs','FaqsController@index');
    Route::post('/sendQuestion', 'FaqsController@storeQuestion');
    Route::post('admin/storeGeneralQuestion', 'FaqsController@storeGeneralQuestion');
    Route::post('admin/generalizeQuestion', 'FaqsController@generalizeQuestion');
    Route::post('admin/showQuestionandAnswer', 'FaqsController@showQuestionandAnswer');
    Route::get('admin/viewQuestions/{intGeneralQuestionId}', 'FaqsController@showQuestions');
    Route::post('admin/saveEditedQuestion', 'FaqsController@saveEditedQuestion');
    Route::post('admin/deleteQuestion', 'FaqsController@deleteQuestion');
    Route::post('admin/storeCategory', 'FaqsController@storeCategory');
    Route::post('admin/getCategoryDetails', 'FaqsController@getCategoryDetails');
    Route::post('admin/updateCategory', 'FaqsController@updateCategory');
    Route::post('admin/categorizeGenQue', 'FaqsController@categorizeGenQue');
    Route::get('admin/viewGeneralQuestions/{intCategoryId}', 'FaqsController@showGeneralQuestions');

    //ADMIN HOMEPAGE VIEW ROUTE
    Route::get('admin/homepageView','HomeContentsController@index');
    //Route::get('admin/homepageView','HomeContentsController@index');
    //Route::resource('admin','HomeContentsController');
    //Route::get('/', 'HomeContentsController@index');
    Route::post('/update', 'HomeContentsController@update');
    Route::post('/updateImage', 'HomeContentsController@updateImage');
    //Route::post('HomeContentsController@update', ['contentid' => $id, 'description' => $inventory_id ]);
    // Route::get('admin', function () {
    //     return view('admin');
    // });


    //NEWS ROUTES
    Route::resource('news', 'NewsController');

    //Admin Account Routes
    Route::get('adminAccount/edit', 'AdminAccountController@edit');
    Route::resource('adminAccount', 'AdminAccountController');

    //reports
    Route::get('participantList/{intEventId}', [
        "uses" => 'RequestsController@participantList',
        "as" => 'participantList'
    ]);
});

//USERS MIDDLEWARE OR HOSPITAL SIDE
Route::group(['middleware' => 'auth:users'], function() {
    // Main page route
    Route::get('hosp/home','HospitalController@index');

    //Hosp Settings
    Route::get('hosp/settings','HospitalSettingsController@index');
    Route::post('hosp/settings/uploadLogo','HospitalSettingsController@uploadLogo')->name('hosp.settings.uploadLogo');
    Route::post('hosp/settings/editHospital','HospitalSettingsController@editHospital')->name('hosp.settings.editHospital');
    Route::post('hosp/settings/editDirector','HospitalSettingsController@editDirector')->name('hosp.settings.editDirector');
    Route::post('hosp/settings/editRepresentative','HospitalSettingsController@editRepresentative')->name('hosp.settings.editRepresentative');
    //
    Route::get('hosp/services','HospitalController@index');
    Route::get('hosp/seminars','HospitalController@seminars');


    Route::resource('hospital_side', 'HospitalController');

    //Pass Variable from View to Controller
    Route::get('create/{intEventId}', [
        "uses" => 'HospitalController@create',
        "as" => 'create'
    ]);

    //PARTICIPANTS ROUTE
    Route::resource('admin/hospitalrequestShow','ParticipantsController');
    Route::post('admin/hospitalrequestShow/storeParticipants','ParticipantsController@store2')->name('hospitalrequestShow.storeParticipants');
    Route::post('/updateRequest','ParticipantsController@updateRequest');
    Route::post('/updatePayment','ParticipantsController@updatePayment');
});

////////////ADMIN LOGIN ROUTES
Route::get('admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');

///////////LOGIN ROUTES
Route::get('hosp/login','Auth\LoginController@showLoginForm')->name('hosp.login');
Route::post('hosp/login','Auth\LoginController@login')->name('hosp.login.submit');;
Route::get('hosp/logout','Auth\LoginController@logout')->name('hosp.logout');

Route::get('hosp/register','RepresentativeRegisterController@showRegisterForm')->name('hosp.register');
Route::post('hosp/register','RepresentativeRegisterController@register')->name('hosp.register');
Route::post('hosp/register/checkRegCode','RepresentativeRegisterController@checkRegCode')->name('hosp.checkRegCode');