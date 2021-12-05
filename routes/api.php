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


route::get('get-states-list','OptionController@getStateList');
route::get('get-city-list/{state_id}','OptionController@getCityList');
route::get('get-bases-list','OptionController@getBasesList');
route::get('get-class-list/{base_id}','OptionController@getClassList');

route::get('/azmoon/count/soal/{azmoon}','OptionController@azmoonCountSoal');

Route::group(['namespace' => 'Dashboard\Api','prefix' => 'dashboard'],function (){
    Route::apiResource('courses',\Education\CourseController::class,['as' => 'dashboard']);
});

/*
 * admin routes
 */


Route::group(['namespace'=>'Api\Admin'], function (){



    // Registration Fee
    Route::get('registration-fees-all','RegistrationFeeController@all');
    Route::get('registration-fee/{id}','RegistrationFeeController@edit');
    Route::post('registration-fee/update/{id}','RegistrationFeeController@update');


});

// student
Route::group(['prefix'=>'admin/student','namespace'=>'Api\Admin'], function (){
    // Students CRUD
    Route::get('students-all','Student\StudentController@index');
    Route::delete('student-delete/{id}','Student\StudentController@delete');
    Route::get('base_class_info/{id}','Student\StudentController@getBaseClassInfo');

});

// student panel  => customize fields
Route::group(['prefix'=>'student','namespace'=>'Api'], function (){
    // Customize fields CRUD
    Route::get('fields/{user}','Student\CustomizeFieldController@fields');
    Route::get('field/values/{user_id}','Student\CustomizeFieldController@fieldValues');
});




