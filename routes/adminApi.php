<?php


use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Dashboard'], function(){

    route::get('dashboard/info','DashboardController@dashboardInfo');
});

// customize fields
Route::group(['prefix' => 'field', 'namespace' => 'CustomizeField'], function () {
    // Customize fields CRUD
    Route::get('all', 'CustomizeFieldController@getCustomField');
    Route::get('is_exist_by_latin', 'CustomizeFieldController@isExistByLatinName');
    Route::get('show/{id}', 'CustomizeFieldController@show');
    Route::post('store', 'CustomizeFieldController@store');
    Route::post('update/{id}', 'CustomizeFieldController@update');
    Route::delete('destroy/{id}', 'CustomizeFieldController@destroy');

    // Option fields CRUD
    route::get('options/{field_id}', 'FieldOptionController@index');
    route::post('option/store', 'FieldOptionController@store');
    route::get('option/edit/{option_id}', 'FieldOptionController@edit');
    route::post('option/update/{option_id}', 'FieldOptionController@update');
    Route::delete('option/destroy/{option_id}', 'FieldOptionController@destroy');
});

//  courses
Route::group(['namespace' => 'Course'], function () {
    route::get('course/classes/{course_id}', 'CourseClassController@courseClasses');
    route::post('course-class/store', 'CourseClassController@store');
    route::delete('course-class/delete/{id}', 'CourseClassController@destroy');


    route::get('active-course-students', 'CourseStudentController@activeCourseStudents');
    route::delete('active-course-student/delete/{id}', 'CourseStudentController@destroy');
    route::get('course-students/{course}', 'CourseStudentController@index');
    route::get('course-students2/{course}', 'CourseStudentController@index2');
});

// users
Route::group(['namespace' => 'User'], function () {
    route::get('students-all', 'StudentController@studentAll');
    route::post('student-quick-register', 'StudentController@quickRegister');
    route::get('student-show/{user}', 'StudentController@show');
    route::get('student-edit/{user}', 'StudentController@edit');
    route::post('student-update', 'StudentController@update');
    route::post('check-student-phone', 'StudentController@checkPhone');
    route::post('check-student-usercode', 'StudentController@checkUsercode');

    route::post('import-student-excel', 'StudentController@uploadStudentExcel');
});

Route::group(['namespace' => 'TariffBase'], function () {
    route::get('tariff-bases', 'TariffBaseController@index');
    route::post('tariff-base/store', 'TariffBaseController@store');
    route::delete('tariff-base/delete/{tariffBase}', 'TariffBaseController@destroy');
});

Route::group(['namespace' => 'Azmoon'], function () {
    route::get('azmoons-all', 'AzmoonController@index');
    route::post('azmoon-store', 'AzmoonController@store');
    route::get('azmoon-show/{azmoon}', 'AzmoonController@show');
    route::delete('azmoon/delete/{azmoon}', 'AzmoonController@destroy');
    Route::get('azmoon-edit/{id}', 'AzmoonController@edit');
    Route::get('azmoon-date-edit/{id}', 'AzmoonController@date_edit');
    Route::post('azmoon-update', 'AzmoonController@update');
    Route::post('azmoon-date-update', 'AzmoonController@date_update');
    Route::post('change-azmoon-status/{id}', 'AzmoonController@changeStatus');
    Route::post('reset-azmoon/{id}', 'AzmoonController@resetAzmoon');

    route::get('normal-poreshnameh-files/{azmoonid}', 'NormalPorseshnamehFileController@index');
    route::delete(
        'normal-poreshnameh-file/delete/{azmoonid}',
        'NormalPorseshnamehFileController@destroy'
    );
    route::post(
        'normal-poreshname-image-upload',
        'NormalPorseshnamehFileController@imageUpload'
    );

    route::get('soal-normal-poreshnameh/{id}', 'NormalPorseshnamehFileController@soalPoreshnameh');
    route::post('normal-porseshnameh-store', 'NormalPorseshnamehFileController@soalPoreshnamehStore');

    route::get(
        'azmoon/analytical-report/{azmoon}',
        'AnalyticalReportController@analyticalReport'
    );
      route::get(
        'azmoon/export-excel/{azmoon}',
        'ExcelReportController@exportReport'
    );
    route::get(
        'azmoon/moment-report/{azmoon}',
        'MomentReportController@report'
    );
    route::post(
        'azmoon/update-student-result',
        'MomentReportController@studentUpdateResult'
    );
    route::post(
        'azmoon/student-result-reset',
        'MomentReportController@studentResetResult'
    );

    route::get(
        'azmoon-classes/{azmoon}',
        'AzmoonClassController@index'
    );
    route::delete(
        'azmoon-class/delete/{class}',
        'AzmoonClassController@destroy'
    );

    Route::post('azmoon-classlist-update', 'AzmoonClassController@update');
});

Route::group(['namespace' => 'Book'], function () {
    route::get('books-all', 'BookController@index');
    route::get('books', 'BookController@books');
    route::post('book/store','BookController@store');
    route::post('book/update','BookController@update');
    route::delete('book/delete/{book}','BookController@destroy');


});

Route::group(['namespace' => 'SMS'], function () {
    route::post('send-sms-group', 'SMSGroupController@sendSMSGroup');
});
Route::group(['namespace' => 'Education'], function () {
    route::get('base/{id}', 'EducationBaseController@fetchBase');
    route::post('class-store', 'EducationClassController@store');
    Route::post('update-class/{id}', 'EducationClassController@update');
    route::delete('class/delete/{id}', 'EducationClassController@destroy');

    Route::get('base-classes/{baseId}', 'EducationClassController@baseClasses');
});

;
