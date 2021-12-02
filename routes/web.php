<?php

use App\CustomizeField;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

route::get('test',function (){
   return $base = \App\EducationalBase::query()->where('base_title','پنجم')->first();
});

route::get('canceled','ErrorPageController@canceled')->name('error.page.canceled');

Route::get('/azmoon/start/{azmoon_code}','Site\HomeController@guestStartAzmoon');

Route::get('/','Site\HomeController@index')->name('site.index');

Route::get('stores','Site\ProductController@index')->name('site.products.index');
Route::get('/product/{product}','Site\ProductController@show')->name('site.products.show');

Route::get('shop-cart','Site\ShopCartController@index')->name('site.shop.carts.index');

Route::get('/welcome', function () {
    /*$users = \App\User::all();
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $rr = 0;
    foreach ($users as $user){
        do{
            //$rr++;
            $randomString = '';
            for ($i = 0; $i <= 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check =\App\User::where('private_code',$randomString)->get();
            //print_r($randomString);
            //echo '</br>';

        }while(!$check->isEmpty());
        $user->update(['private_code'=>$randomString]);

    }*/
    \App\User::create([
        'level'=>'admin',
        'email'=>'admin@admin.com',
        'first_name'=>'saeed',
        'last_name'=>'gsm',
        'password'=>bcrypt('11111111'),
    ]);

   // $oldClasses = \Illuminate\Support\Facades\DB::table('classes')->orderBy('id','asc')->get();
    /*foreach ($oldClasses as $class){

        $newClass = \App\EducationalClass::create([
            'base_id'=>$class->level,
            'class_title'=>$class->name
        ]);
        $classStudents = \Illuminate\Support\Facades\DB::table('old_users')
            ->orderBy('id','asc')
            ->whereNotNull('usercode')
            ->where('usercode','!=',0)
            ->where('class',$class->id)
            ->get();

        if ($classStudents->isNotEmpty()){
            foreach ($classStudents as $st){
                $users = \App\User::all();
                $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
                $charactersLength = strlen($characters);
                $rr = 0;
               // foreach ($users as $us){
                    do{
                        //$rr++;
                        $randomString = '';
                        for ($i = 0; $i <= 8; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        $check =\App\User::where('private_code',$randomString)->get();


                    }while(!$check->isEmpty());
                    //$user->update(['private_code'=>$randomString]);

              //  }

                $user = \App\User::create([
                    'private_code'=>$randomString,
                    'level'=>'student',
                    'usercode'=>$st->usercode,
                    'userpass'=>$st->pass,
                    'password'=>bcrypt($st->pass),
                    'first_name'=>$st->getname,
                    'last_name'=>$st->getfamily,
                ]);
                \App\InfoStudent::create(['user_id'=>$user->id]);
                \App\RegisterClassStudent::create([
                    'user_id'=>$user->id,
                    'base_id'=>$newClass->base_id,
                    'class_id'=>$newClass->id
                ]);
            }
        }
    }*/
    /*$stOld2 = \Illuminate\Support\Facades\DB::table('old_users')
        ->orderBy('id','asc')
        ->whereNotNull('usercode')
        ->where('usercode','!=',0)
        // ->whereNull('class','and')
        ->where('class','==',0)
        //  ->orWhere('class','==',$v)
        ->get();
    foreach ($stOld2 as $item){

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        do{
            $randomString = '';
            for ($i = 0; $i <= 8; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $check =\App\User::where('private_code',$randomString)->get();


        }while(!$check->isEmpty());

        $user = \App\User::create([
            'private_code'=>$randomString,
            'level'=>'student',
            'usercode'=>$item->usercode,
            'userpass'=>$item->pass,
            'password'=>bcrypt($item->pass),
            'first_name'=>$item->getname,
            'last_name'=>$item->getfamily,
        ]);
        \App\InfoStudent::create(['user_id'=>$user->id]);
        \App\RegisterClassStudent::create([
            'user_id'=>$user->id,
            'base_id'=>$item->level,
            //'class_id'=>
        ]);
    }*/
    //$oCount = $oldClasses->count();

   // $users = \App\User::all();
//$row=4;
    //return view('welcome');
})->name('home.index');

route::get('check/acc/pp','CheckAccountController@copy')->name('check.account.copy');
route::get('check/acc','CheckAccountController@check')->name('check.account');
route::post('check/acc/st','CheckAccountController@checkAccount')->name('check.account.st');

// http error code pages
//route::get('404','Site/HttpCodePageController@404')->name('http.code.404');

Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    Route::get('confirm/code','RegisterController@confirmRegisterCodeForm')->name('register.confirm.code.form');
    Route::post('confirm/code','RegisterController@getCode')->name('register.confirm.code');

    Route::get('/insert/phone/{pc}','LoginController@insertPhoneForm')->name('user.insert.phone.form');
    Route::post('/check/phone/{pc}','LoginController@checkPhone')->name('user.check.phone');

   // Route::get('/check/phone/{pc}','LoginController@checkPhoneForm')->name('user.check.phone.exist');

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

    Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'ConfirmPasswordController@confirm');

    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');



});



Route::get('/home', 'HomeController@index')->name('home');
