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

Route::get('/', 'FrontendController@index')->name('root');
Route::get('confirm/{devi}/{mail}/user/{hash}', 'FrontendController@confirm')->name('confirm');
Route::post('suscriber', 'SuscriberController@store')->name('suscriber.store');
Route::get('suscriber', function (){
    return redirect()->route('root');
});



Route::group([ 'middleware'=>'suscriber'],function () {
    Route::post('section/store', 'FrontendController@store')->name('section.store');
    Route::post('section/{section}', 'FrontendController@show')->name('section.show');
    Route::get('section/{section}', 'FrontendController@show');
    Route::get('section', 'FrontendController@categories')->name('section');
    Route::get('senddevi/{devi}', 'FrontendController@sendDevi')->name('senddevi');
    Route::get('command/{devi}', 'FrontendController@command')->name('command');


    Route::get('end', 'FrontendController@end')->name('fin');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['as'=>'admin.','prefix'=>'admin', 'middleware'=>['auth'], 'namespace'=>'Admin'],function (){
    Route::get('suscrib0','SuscriberController@suscriber0')->name('suscrib0.index');
    Route::resource('suscriber', 'SuscriberController');
    Route::resource('user', 'UserController');
    Route::resource('devi', 'DeviController');
    Route::resource('command', 'CommandController');
    Route::group(['prefix'=>'question'],function () {
        Route::post('question/add/{section}','QuestionController@createQuestionFromSection')->name('question.fromsection');
        Route::put('reponse/add/{question}','ReponseController@createReponseFromQuestion')->name('question.fromquestion');
        Route::get('reponse/add/{question}','ReponseController@createReponseFromQuestion')->name('question.fromquestiong');
        Route::resource('section', 'SectionController');
        Route::resource('question', 'QuestionController');
        Route::resource('reponse', 'ReponseController');
    });
});
