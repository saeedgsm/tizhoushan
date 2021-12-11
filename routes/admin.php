<?php


use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', 'LoaderController@dashboard')->name('dashboard');

route::get('panel', 'PanelController@index')->name('panel');
route::get('panel/edit', 'PanelController@edit')->name('panel.edit');
route::patch('panel/update', 'PanelController@update')->name('panel.update');

// students
route::resource('students', 'InfoStudentController');
route::get('student/profile/unchecked', 'InfoStudentController@uncheckedProfiles')->name('student.profile.unchecked');
route::get('student/profile/submit/{student}', 'InfoStudentController@submitProfiles')->name('student.profile.submit');

route::resource('teachers', 'InfoTeacherController');

// cadres
route::resource('cadres', 'CadreController');

// teacherCourses
route::resource('teacherCourses', 'TeacherCourseController');

// azmoons
route::resource('azmoons', 'AzmoonController');
route::get('azmoon/edit/date/{azmoon}', 'AzmoonController@editDate')->name('azmoon.date.edit');
route::patch('azmoon/update/date/{azmoon}', 'AzmoonController@updateDate')->name('azmoon.date.update');


route::resource('azmoonSoalatFiles', 'AzmoonSoalatFileController');
route::resource('porseshnamehs', 'AzmoonPorseshnamehController');
route::resource('soalbsoals', 'AzmoonSoalbsoalController');
route::get('azmoon/result/reset{azmoon}', 'AzmoonController@resultReset')->name('azmoons.result.reset');
route::get('azmoon/change/status/{azmoon}', 'AzmoonController@changeStatus')->name('azmoon.change.status');

route::post('insert.advance.soal', 'AzmoonPorseshnamehController@insertAdvanceSoal')->name('insert.advance.soal');
route::post('store.advanced.soal', 'AzmoonPorseshnamehController@StoreAdvancedSoal')->name('advanced.porseshnamehs.store');

route::get('azmoon/advanced/proseshnamefile/create/{azmoon}', 'AzmoonAdvancedFileController@create')->name('advanced.porseshname.file.create');
route::post('azmoon/advanced/proseshnamefile/store/{azmoon}', 'AzmoonAdvancedFileController@store')->name('advanced.porseshname.file.store');
route::delete('azmoon/advanced/proseshnamefile/destroy/{advancedFile}', 'AzmoonAdvancedFileController@destroy')->name('advanced.porseshname.file.destroy');

route::get('azmoon/analytical/report/ago/{azmoon}', 'Azmoon\AnalyticalReportController@agoReport')->name('azmoon.analytical.report.ago');

route::get('azmoon/report/{azmoon}', 'AzmoonController@exportReport')->name('azmoon.reports');
route::get('azmoon/report/quick/{azmoon}/{value}', 'AzmoonController@quickReport')->name('azmoon.quick.reports');
route::get('azmoon/result/reset/user/{result}', 'AzmoonController@resultResetUser')->name('azmoon.result.reset.user');

Route::resource('productCategories', 'Product\ProductCategoryController');
Route::resource('products', 'Product\ProductController');

Route::resource('ticketCategories', 'TicketCategoryController');
Route::resource('tickets', 'TicketController');

route::resource('custom/fields', 'CustomFieldController');


route::resource('defaultCovers', 'DefaultCoverController');
route::resource('exclusives', 'Azmoon\AzmoonExclusiveController');

route::get('setting','SettingController@settingView')->name('setting.all');
route::get('setting/sms','SettingController@smsStatus')->name('setting.sms');


Route::get('/{vue_capture?}', function () {
    return view('panel.admin.master');
})->where('vue_capture', '[\/\w\.-].*');
