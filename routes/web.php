<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', function (){
    return view('welcome');
});

//Route::get('/mailtest', function (){
//    return view('mails.contact.forward');
//});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/contact', 'ContactController@store');
Route::post('/subscribe', 'NewsletterController@store');


//MPESA ROUTES
Route::get('c2b', 'PaymentsController@c2b');
Route::get('b2c','PaymentsController@b2c');
Route::post('confirm','PaymentsController@confirmmpesa');
Route::post('validate','PaymentsController@validatempesa');
Route::post('result','PaymentsController@result');
Route::post('qtimeout','PaymentsController@qtimeout');
Route::get('registerurl', 'PaymentsController@register_urls');
Route::get('reverse','PaymentsController@reverse');
Route::get('balance','PaymentsController@balance');
Route::get('stkpush','PaymentsController@stkpush');



Route::group(['middleware' => ['auth']], function (){

    Route::get('/user', function (){
        return auth()->user();
    });

    //adminstats
    Route::get('/adminstats' , 'HomeController@stats');

    //category
    Route::get('/categories' , 'CategoryController@index');
    Route::post('/category' , 'CategoryController@store');
    Route::delete('/category/{category}' , 'CategoryController@destroy');



    //licenses
    Route::get('/prices' , 'PriceController@index')->withoutMiddleware('auth');
    Route::get('/basic' , 'PriceController@primary')->withoutMiddleware('auth');
    Route::post('/uprice/{price}' , 'PriceController@update');

//    blog
    Route::post('/addBlog' , 'BlogController@store');
    Route::get('/getBlogs' , 'BlogController@index')->withoutMiddleware('auth');
    Route::get('/adminBlogs' , 'BlogController@indexAdmin')->withoutMiddleware('auth');
    Route::get('/getBlog/{blog}' , 'BlogController@show')->withoutMiddleware('auth');
    Route::post('/updateBlog/{blog}' , 'BlogController@update');
    Route::delete('/deleteBlog/{blog}' , 'BlogController@destroy');


//    drumkit

    Route::post('/addDrumkit' , 'DrumkitController@store');
    Route::get('/frontDrumkits' , 'DrumkitController@getFrontKits')->withoutMiddleware('auth');
    Route::get('/downloadDrumkit/{drumkit}' , 'DrumkitController@download')->withoutMiddleware('auth');
    Route::get('/getDrumkits' , 'DrumkitController@index');
    Route::get('/getDrumkit/{drumkit}' , 'DrumkitController@show')->withoutMiddleware('auth');
    Route::post('/updateDrumkit/{drumkit}' , 'DrumkitController@update');
    Route::delete('/deleteDrumkit/{drumkit}' , 'DrumkitController@destroy');

//beats


    Route::post('/addBeat' , 'BeatController@store');
    Route::get('/frontBeats' , 'BeatController@getFrontBeats')->withoutMiddleware('auth');
    Route::get('/downloadBeat/{beat}' , 'BeatController@download')->withoutMiddleware('auth');
    Route::get('/getBeats' , 'BeatController@index');
    Route::get('/getBeat/{beat}' , 'BeatController@show')->withoutMiddleware('auth');
    Route::post('/updateBeat/{beat}' , 'BeatController@update');
    Route::delete('/deleteBeat/{beat}' , 'BeatController@destroy');



    //default
    Route::get('/{any}', 'HomeController@index')->where('any', '.*');
});



Route::group(['middleware' => ['guest']], function (){

    Route::get('/{any}',  function (){
        return view('welcome');
    })->where('any', '.*');

});





