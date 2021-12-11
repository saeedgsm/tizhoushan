<?php

use App\Http\Controllers\Dashboard\Api\Education\CourseController;
use App\Http\Controllers\Dashboard\Api\Setting\RoleController;

Route::group(['prefix' => 'dashboard'],function (){
    Route::apiResource('courses',CourseController::class,['as' => 'dashboard']);
    Route::apiResource('roles', RoleController::class,['as' => 'dashboard']);
});
