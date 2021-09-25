<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['checkStudentTariffBases','checkStudentInfo']],function(){
    Route::get('/dashboard','LoaderController@dashboard')->name('dashboard');

    route::resource('books','BookController');

    Route::group(['middleware' => ['prevent-back-history']],function(){
        route::get('azmoon/result/{azmoon}','AzmoonController@result')->name('azmoons.result');
    });

    route::get('surveys','SurveyController@index')->name('surveys.all');
    route::get('survey/show/{survey}','SurveyController@show')->name('surveys.show');
    route::get('survey/start/{survey}','SurveyController@start')->name('surveys.start');
    route::post('survey/end','SurveyController@endSurvey');
    route::get('survey/result/{survey}','SurveyController@result')->name('surveys.result');

    route::get('azmoons','AzmoonController@index')->name('azmoons.all');
    route::get('azmoon/show/{azmoon}','AzmoonController@show')->name('azmoons.show');
    route::get('azmoon/karnameh/{azmoon}','AzmoonController@karnameh')->name('azmoons.karnameh');
    route::get('azmoon/karnameh/advanced/{azmoon}','AzmoonController@karnamehAdvanced')
        ->name('azmoons.karnameh.advanced');

    route::get('export/karnameh/{azmoon}','AzmoonController@exportPdf')->name('azmoons.export.pdf');

    route::get('azmoon/start/{azmoon}','AzmoonController@start')->name('azmoons.start');
    route::post('azmoon/end/{azmoon}','AzmoonController@end')->name('azmoons.end');

    route::get('iframe','LoaderController@iframe')->name('iframe');

    route::post('/azmoon/end','AzmoonController@endAzmoon');
    route::post('/azmoon/advanced/end','AzmoonController@endAzmoonAdvanced');

    route::post('/azmoon/result/update','AzmoonController@updateResult');
    route::post('/azmoon/advanced/result/update','AzmoonController@updateAdvancedResult');

    route::get('registration-fee/payment/result','RegistrationFeeController@paymentResult')
        ->name('registration.fee.payment.result');

    route::get('tariff/payment/result','TariffBaseController@paymentResult')
        ->name('tariff.bases.payment.result');

    route::get('panel','PanelController@index')->name('panel');

    route::post('payment/preview','AzmoonPaymentController@preview')->name('azmoon.payment.preview');
    route::post('payment/request','AzmoonPaymentController@request')->name('azmoon.payment.request');
    route::get('payment/verify','AzmoonPaymentController@verify')->name('azmoon.payment.verify');

});



route::get('/panel/edit','PanelController@edit')->name('panel.edit');
route::patch('panel/update','PanelController@update')->name('panel.update');

route::get('registration-fees','RegistrationFeeController@index')->name('registration.fee.all');
route::get('registration-fee','RegistrationFeeController@show')->name('registration.fee.show');
route::get('registration-fee/request','RegistrationFeeController@request')->name('registration.fee.request');
route::get('registration-fee/verify','RegistrationFeeController@verify')->name('registration.fee.verify');

route::get('tariffs','TariffBaseController@index')->name('tariff.bases.all');
route::get('tariff','TariffBaseController@show')->name('tariff.bases.show');
route::get('tariff/request','TariffBaseController@request')->name('tariff.bases.request');
route::get('tariff/verify','TariffBaseController@verify')->name('tariff.bases.verify');

route::get('class-select','RegisterController@select')->name('register.select');
route::post('register/update','RegisterController@update')->name('register.update');



/*Route::get('/{vue_capture?}', function () {
    return view('panel.student.master');
})->where('vue_capture', '[\/\w\.-].*');*/