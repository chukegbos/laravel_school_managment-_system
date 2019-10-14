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
Auth::routes();
Route::get('/', function () {

	return redirect()->route('login');
});
Auth::routes();
Route::get('/adminlogin', function () {
	return view('adminlogin');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/stafflogin', 'SchoolController@stafflogin')->name('stafflogin');
//Password
Route::get('/password', 'HomeController@passwordget')->name('passwordget');
Route::post('/password', 'HomeController@password')->name('changepassword');

Route::prefix('admin')->group(function () {  
    
	Route::get('/schoolsetting', 'HomeController@schoolsetting')->name('schoolsetting');
	Route::post('/schoolsetting', 'HomeController@storeschoolsetting')->name('storeschoolsetting');
	Route::get('/schoolstamp', 'HomeController@schoolstamp')->name('schoolstamp');
	Route::post('/schoolstamp', 'HomeController@storeschoolstamp')->name('storeschoolstamp');

	Route::get('/schoollogo', 'HomeController@schoollogo')->name('schoollogo');
	Route::post('/schoollogo', 'HomeController@storeschoollogo')->name('storeschoollogo');

	Route::get('/admins', 'HomeController@admins')->name('admins');
	Route::post('/admins', 'HomeController@storeadmin')->name('storeadmin');
	Route::delete('/destroyadmin/{id}', 'HomeController@destroyadmin')->name('destroyadmin');

	Route::get('/resource', 'HomeController@resource')->name('resource');
	Route::post('/resource', 'HomeController@storeresource')->name('storeresource');
	Route::delete('/destroyresource/{id}', 'HomeController@destroyresource')->name('destroyresource');


	Route::get('/schools', 'HomeController@schools')->name('schools');
	Route::get('/create-school', 'HomeController@create_school')->name('create_school');
	Route::post('/create-school', 'HomeController@storeschool')->name('storeschool');
	Route::get('/visit', 'HomeController@visit')->name('visit');
	Route::post('/switchback', 'HomeController@switchback')->name('switchback');
	Route::delete('/deleteschool/{id}', 'HomeController@destroy')->name('deleteschool');
	Route::get('/sessions', 'HomeController@sessions')->name('sessions');
	Route::get('/activate-session', 'HomeController@activate_session')->name('activate-session');
	Route::post('/sessions', 'HomeController@storesessions')->name('storesessions');
	Route::post('/updatesession', 'HomeController@updatesession')->name('updatesession');
	Route::delete('/destroysession/{id}', 'HomeController@destroysession');

	Route::post('/editschoolfees', 'HomeController@editschoolfees')->name('editschoolfees');
	Route::get('/schoolfeeshistory', 'HomeController@schoolfeeshistory')->name('schoolfeeshistory');
	Route::get('/manageschoolfees', 'HomeController@manageschoolfees')->name('manageschoolfees');
	Route::get('/markfee', 'HomeController@markfee')->name('markfee');

	Route::get('/standard', 'HomeController@standard')->name('standard');
	Route::post('/storestandard', 'HomeController@storestandard');
	Route::post('/standard', 'HomeController@updatestandard');
	Route::put('/standard', 'HomeController@updatestandard');

	Route::get('/subject', 'HomeController@subjects')->name('subjects');
	Route::post('/subject', 'HomeController@storesubject');
	Route::delete('/destroysubject/{id}', 'HomeController@destroysubject');

	Route::get('/staff', 'HomeController@staff')->name('staff');
	Route::get('/addteacher', 'HomeController@addteacher')->name('addteacher');
	Route::post('/addteacher', 'HomeController@storeteacher')->name('storeteacher');
	Route::delete('/destroyteacher/{id}', 'HomeController@destroyteacher');

	Route::get('/teacherprofile', 'HomeController@teacherprofile')->name('teacherprofile');
	Route::get('/editstaff', 'HomeController@editstaff');
	Route::post('/editstaff/{id}', 'HomeController@updatestaff');
	Route::put('/editstaff/{id}', 'HomeController@updatestaff');


	Route::delete('/destroystudent/{id}', 'HomeController@destroystudent');

	//Academics
	Route::get('/classes', 'HomeController@classes')->name('admin.class');
	Route::post('/classes', 'HomeController@storeclasses')->name('admin.storeclass');
	Route::delete('/destroyclass/{id}', 'HomeController@destroyclass');
	Route::post('/form_teacher', 'HomeController@form_teacher')->name('form_teacher');
	Route::post('/subject_teacher', 'HomeController@subject_teacher')->name('subject_teacher');
	Route::post('/registersubject', 'HomeController@registersubject');

	Route::get('/teacherprofile', 'HomeController@teacherprofile')->name('add-Student');
	Route::get('/editstaff', 'HomeController@editstaff');
	Route::post('/editstaff/{id}', 'HomeController@updatestaff');
	Route::put('/editstaff/{id}', 'HomeController@updatestaff');


	Route::post('/editprofile/{id}', 'ZallaController@updateswift');
	Route::put('/editprofile/{id}', 'ZallaController@updateswift');
	Route::get('/password', 'ZallaController@passwordget')->name('swiftpasswordget');
	Route::post('/password', 'ZallaController@password')->name('ZallaChangePassword');

	Route::get('/students', 'HomeController@allstudents')->name('allstudents');
	Route::get('/addstudent', 'HomeController@addstudent')->name('add_Student');
	Route::post('/addstudent', 'HomeController@storestudent')->name('add-Student');
    Route::post('/station', 'HomeController@station')->name('station');
	Route::get('/studentprofile', 'HomeController@studentprofile')->name('studentprofile');
	Route::get('/editstudent', 'HomeController@editstudent')->name('admin.editstudent');
	
	Route::post('/editstudent/{id}', 'HomeController@updatestudent');
	Route::put('/editstudent/{id}', 'HomeController@updatestudent');
	
	//Result Management
	Route::get('/addresult', 'HomeController@addresult')->name('addresult');
	Route::post('/addresult', 'HomeController@getclass')->name('getclass');
	Route::get('/resultsheet', 'HomeController@resultsheet')->name('resultsheet');
	Route::post('/storeresult', 'HomeController@storeresult');
	Route::put('/storeresult', 'HomeController@storeresult');

	Route::get('/viewresult', 'HomeController@viewresult')->name('viewresult');
	Route::post('/viewresult', 'HomeController@findresult')->name('findresult');
	Route::get('/getresult', 'HomeController@getresult')->name('getresult');

	Route::get('/hostels', 'HomeController@hostels')->name('hostels');
	Route::post('/hostels', 'HomeController@storehostel')->name('storehostels');
	Route::post('/updatehostel', 'HomeController@updatehostel')->name('updatehostel');

	//Route::post('/updatesession', 'HomeController@updatesession')->name('updatesession');
	Route::delete('/destroyhostel/{id}', 'HomeController@destroyhostel');
	Route::get('/bed', 'HomeController@bed')->name('bed');
	Route::get('/addbed', 'HomeController@addbed')->name('addbed');
	Route::get('/removebed', 'HomeController@removebed')->name('removebed');
	Route::get('getbed/{id}','HomeController@getbed');

	Route::get('/books', 'HomeController@books')->name('books');
	Route::post('/books', 'HomeController@storebooks')->name('storebooks');
	Route::post('/editbook', 'HomeController@editbook')->name('editbook');
	Route::get('/addbook', 'HomeController@addbook')->name('addbook');
	Route::get('/reducebook', 'HomeController@removebook')->name('removebook');
	Route::get('/lend', 'HomeController@lend')->name('lend');
	Route::get('/lendhistory', 'HomeController@lendhistory')->name('lendhistory');
	Route::get('/marksuccess', 'HomeController@marksuccess')->name('marksuccess');
	Route::post('/lend', 'HomeController@storelend')->name('storelend');

	Route::get('/mail', 'HomeController@mail')->name('mail');
	Route::post('/compose', 'HomeController@storecompose')->name('storecompose');
	Route::get('/compose', 'HomeController@compose')->name('compose');
	Route::get('/sentmail', 'HomeController@sentmail')->name('sentmail');
	Route::get('/readmail', 'HomeController@readmail')->name('readmail');
	Route::get('/openticket', 'HomeController@openticket')->name('openticket');


	//Staff
	Route::get('/getformclass', 'HomeController@getformclass')->name('getformclass');
	Route::get('/formclass', 'HomeController@formclass')->name('formclass');
	Route::post('/subjectcheck', 'HomeController@subjectcheck');
	Route::get('/subjectclass', 'HomeController@subjectclass')->name('subjectclass');
	Route::get('/subjectclasshistory', 'HomeController@subjectclasshistory');
	Route::get('/readyresult', 'HomeController@readyresult');
    
    Route::get('/addassessment', 'HomeController@addassessment')->name('addassessment');
	Route::post('/addassessment', 'HomeController@getassessment')->name('getassessment');
	Route::get('/assessmentsheet', 'HomeController@assessmentsheet')->name('assessmentsheet');
	Route::post('/assessmentsheet', 'HomeController@storeassessmentsheet')->name('storeassessmentsheet');


	Route::post('/extendtime', 'HomeController@extendtime')->name('extendtime');
	Route::post('/extendactive', 'HomeController@extendactive')->name('extendactive');
	Route::get('/activate', 'HomeController@activate')->name('activate');
	Route::get('/deactivate', 'HomeController@deactivate')->name('deactivate');
	Route::get('/trial', 'HomeController@trial')->name('trial');

	Route::get('/admissionform', 'HomeController@admissionform')->name('admissionform');
	Route::post('/admissionform', 'HomeController@storeadmissionform')->name('storeadmissionform');

	Route::get('/applicant', 'HomeController@applicant')->name('applicant');
	Route::get('/condition', 'HomeController@condition')->name('condition');
	Route::get('/applicantprofile', 'HomeController@applicantprofile')->name('applicantprofile');

	Route::get('/feetype', 'HomeController@feetype')->name('feetype');
	Route::post('/feetype', 'HomeController@storefeetype');
	Route::get('/editfeetype/{id}', 'HomeController@editfeetype');
	Route::post('/editfeetype/{id}', 'HomeController@updatetfeetype');
	Route::put('/editfeetype/{id}', 'HomeController@updatefeetype');
	Route::delete('/deletefeetype/{id}', 'HomeController@destroyfeetype');
	Route::get('/type', 'HomeController@type')->name('type');
	Route::get('/invoicelist', 'HomeController@invoicelist')->name('invoicelist');
	Route::get('/invoice', 'HomeController@invoice')->name('invoice');
	Route::post('/paysalary', 'HomeController@paysalary')->name('paysalary');


	Route::get('/selecttype', 'HomeController@selecttype')->name('selecttype');
	Route::post('/storepayment', 'HomeController@storepayment');
	Route::get('/receipt', 'HomeController@receipt')->name('receipt');
	Route::get('/account', 'HomeController@account')->name('account');
	Route::Post('/account', 'HomeController@account')->name('searchaccount');


	Route::get('/pinused', 'HomeController@pinused')->name('pinused');
	Route::get('/pinunused', 'HomeController@pinunused')->name('pinunused');
	Route::get('/generatepin', 'HomeController@generatepin')->name('generatepin');
	Route::post('/generatepin', 'HomeController@storegeneratepin')->name('storegeneratepin');



	Route::get('/learning', 'ResourceController@index')->name('learning');
	Route::get('/notes', 'ResourceController@notes')->name('notes');
	Route::get('/viewnote', 'ResourceController@viewnote')->name('viewnote');
	Route::post('/note', 'ResourceController@storenote')->name('storenote');
	Route::post('/updatenote', 'ResourceController@updatenote')->name('updatenote');
	Route::delete('/destroynote/{id}', 'ResourceController@destroynote')->name('destroynote');


	Route::get('/putassignment', 'ResourceController@putassignment')->name('putassignment');
	Route::get('/viewassignment', 'ResourceController@viewassignment')->name('viewassignment');
	Route::get('/viewsubmitted', 'ResourceController@viewsubmitted')->name('viewsubmitted');
	Route::post('/submitassignment', 'ResourceController@submitassignment')->name('submitassignment');
	Route::post('/putassignment', 'ResourceController@storeassignment')->name('storeassignment');
	Route::post('/addscore', 'ResourceController@addscore')->name('addscore');
	Route::post('/updateassignment', 'ResourceController@updateassignment')->name('updateassignment');
	Route::delete('/destroyassignment/{id}', 'ResourceController@destroyassignment')->name('destroyassignment');
});
Route::get('/admission', 'AdmissionController@index')->name('getadmission');
Route::post('/admission', 'AdmissionController@storeadmission')->name('storeadmission');
Route::get('/back', 'AdmissionController@back')->name('back');
Route::post('/passwordemail', 'AdmissionController@passwordemail')->name('passwordemaill');

Route::post('/search','HomeController@search');
Auth::routes();


