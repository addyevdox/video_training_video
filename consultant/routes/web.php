<?php
include_once 'web_builder.php';
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

Route::pattern('slug', '[a-z0-9- _]+');

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function () {

    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return view('admin/404');
    });
    Route::get('500', function () {
        return view('admin/500');
    });
    # Lock screen
    Route::get('{id}/lockscreen', 'UsersController@lockscreen')->name('lockscreen');
    Route::post('{id}/lockscreen', 'UsersController@postLockscreen')->name('lockscreen');
    # All basic routes defined here
    Route::get('login', 'AuthController@getSignin')->name('login');
    Route::get('signin', 'AuthController@getSignin')->name('signin');
    Route::post('signin', 'AuthController@postSignin')->name('postSignin');
    Route::post('signup', 'AuthController@postSignup')->name('admin.signup');
    Route::post('forgot-password', 'AuthController@postForgotPassword')->name('forgot-password');
    Route::get('login2', function () {
        return view('admin/login2');
    });


    # Forgot Password Confirmation
//    Route::get('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm')->name('forgot-password-confirm');
//    Route::post('forgot-password/{userId}/{passwordResetCode}', 'AuthController@getForgotPasswordConfirm');

    # Logout
    Route::get('logout', 'AuthController@getLogout')->name('logout');

    # Account Activation
    Route::get('activate/{userId}/{activationCode}', 'AuthController@getActivate')->name('activate');
});


Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {


    # Dashboard / Index
    Route::get('/', 'JoshController@showHome')->name('dashboard');
});

Route::group(['prefix' => 'admin','namespace'=>'Admin', 'middleware' => 'admin', 'as' => 'admin.'], function () {

    # User Management
    Route::group([ 'prefix' => 'users'], function () {
        Route::get('data', 'UsersController@data')->name('users.data');
        Route::get('{user}/delete', 'UsersController@destroy')->name('users.delete');
        Route::get('{user}/confirm-delete', 'UsersController@getModalDelete')->name('users.confirm-delete');
        Route::get('{user}/restore', 'UsersController@getRestore')->name('restore.user');
//        Route::post('{user}/passwordreset', 'UsersController@passwordreset')->name('passwordreset');
        Route::post('passwordreset', 'UsersController@passwordreset')->name('passwordreset');


    });

    Route::group(['prefix' => 'video'], function () {
        Route::get('{video}/delete', 'VideoController@destroy')->name('video.delete');
        Route::get('{video}/confirm-delete', 'VideoController@getModalDelete')->name('video.confirm-delete');
        Route::get('{video}/restore', 'VideoController@restore')->name('video.restore');
        Route::post('{video}/storecomment', 'VideoController@storeComment')->name('storeComment');
    });

    Route::resource('video', 'VideoController');

    Route::get('answer', 'SurveyAnsController@index')->name('surveyAns');
    Route::get('answer/{id}', 'SurveyAnsController@getAnswer')->name('survey.answer');
    Route::post('answer/store', 'SurveyAnsController@store')->name('survey.answer.store');
    Route::get('answer/delete/{id}', 'SurveyAnsController@delete')->name('survey.answer.delete');
    Route::get('answer/edit/{id}', 'SurveyAnsController@edit')->name('survey.answer.edit');
    Route::post('answer/update', 'SurveyAnsController@update')->name('survey.answer.update');


    Route::get('question', 'SurveyQuesController@index')->name('surveyQues');
    Route::get('question/{id}', 'SurveyQuesController@getQuestion')->name('survey.question');
    Route::post('question/store', 'SurveyQuesController@store')->name('survey.question.store');
    Route::get('question/delete/{id}', 'SurveyQuesController@delete')->name('survey.question.delete');
    Route::get('question/edit/{id}', 'SurveyQuesController@edit')->name('survey.question.edit');
    Route::post('question/update', 'SurveyQuesController@update')->name('survey.question.update');

    Route::resource('users', 'UsersController');
/************ bulk import ****************************/
    Route::get('bulk_import_users', 'UsersController@import');
    Route::post('bulk_import_users', 'UsersController@importInsert');
    /****************bulk download **************************/
    Route::get('download_users/{type}', 'UsersController@downloadExcel');

    Route::get('deleted_users',['before' => 'Sentinel', 'uses' => 'UsersController@getDeletedUsers'])->name('deleted_users');



    /*routes for blog*/
    Route::group(['prefix' => 'blog'], function () {
        Route::get('{blog}/delete', 'BlogController@destroy')->name('blog.delete');
        Route::get('{blog}/confirm-delete', 'BlogController@getModalDelete')->name('blog.confirm-delete');
        Route::get('{blog}/restore', 'BlogController@restore')->name('blog.restore');
        Route::post('{blog}/storecomment', 'BlogController@storeComment')->name('storeComment');
    });
//    Route::resource('blog', 'BlogController');

    /*routes for blog category*/
    Route::group(['prefix' => 'blogcategory'], function () {
        Route::get('{blogCategory}/delete', 'BlogCategoryController@destroy')->name('blogcategory.delete');
        Route::get('{blogCategory}/confirm-delete', 'BlogCategoryController@getModalDelete')->name('blogcategory.confirm-delete');
        Route::get('{blogCategory}/restore', 'BlogCategoryController@getRestore')->name('blogcategory.restore');
    });
    Route::resource('blogcategory', 'BlogCategoryController');
    /*routes for file*/
    Route::group(['prefix' => 'file'], function () {
        Route::post('create', 'FileController@store')->name('store');
        Route::post('createmulti', 'FileController@postFilesCreate')->name('postFilesCreate');
//        Route::delete('delete', 'FileController@delete')->name('delete');
        Route::get('{id}/delete', 'FileController@destroy')->name('file.delete');
        Route::get('data', 'FileController@data')->name('file.data');
        Route::get('{user}/delete', 'FileController@destroy')->name('users.delete');

    });


});



# Remaining pages will be called from below controller method
# in real world scenario, you may be required to define all routes manually

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('{name?}', 'JoshController@showView');
});

#FrontEndController
Route::get('login', 'FrontEndController@getLogin')->name('login');
Route::post('login', 'FrontEndController@postLogin')->name('login');
Route::get('register', 'FrontEndController@getRegister')->name('register');
Route::post('register','FrontEndController@postRegister')->name('register');
Route::get('activate/{userId}/{activationCode}','FrontEndController@getActivate')->name('activate');
Route::get('forgot-password','FrontEndController@getForgotPassword')->name('forgot-password');
Route::post('forgot-password', 'FrontEndController@postForgotPassword');

Route::group(['middleware' => 'user'], function () {




# Forgot Password Confirmation
    Route::post('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@postForgotPasswordConfirm');
    Route::get('forgot-password/{userId}/{passwordResetCode}', 'FrontEndController@getForgotPasswordConfirm')->name('forgot-password-confirm');
# My account display and update details

    Route::put('my-account', 'FrontEndController@update');
    Route::get('my-account', 'FrontEndController@myAccount')->name('my-account');

    Route::get('logout', 'FrontEndController@getLogout')->name('logout');

#frontend views
    //Route::get('/', 'VideoController@index')->name('home');
    Route::name('home')->get('/')->uses('VideoController@index');

    Route::get('blog','BlogController@index')->name('blog');
    Route::get('blog/{slug}/tag', 'BlogController@getBlogTag');
    Route::get('blogitem/{slug?}', 'BlogController@getBlog');
    Route::post('blogitem/{blog}/comment', 'BlogController@storeComment');

//news
    Route::get('news', 'NewsController@index')->name('news');
    Route::get('news/{news}', 'NewsController@show')->name('news.show');

    Route::get('survey/{id}', 'SurveyController@index')->name('survey');
    Route::post('survey/reply', 'SurveyController@reply')->name('reply');


});

