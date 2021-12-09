<?php

use App\Http\Controllers\Dashboard\Api\Education\CourseController;

Route::group(['prefix' => 'dashboard'],function (){
    Route::apiResource('courses',CourseController::class,['as' => 'dashboard']);
});
