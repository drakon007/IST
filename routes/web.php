<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\InterpretationController;
use App\Http\Controllers\QuestionController;
//use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
   Route::controller(AuthController::class)->group(function () {
      Route::get('/login', 'login')->name('login');
      Route::post('/auth','auth')->name('auth');
      Route::post('/adduser', 'adduser')->name('adduser');
      Route::get('/create', 'create')->name('create');
      Route::get('/logout', 'logout')->name('logout');
   });
});

Route::prefix('interpretation')->group(function () {
    Route::controller(InterpretationController::class)->group(function() {
        Route::get('/render/{id_test}', 'render')->name('renderInter')->middleware('auth');
        Route::get('/get/{id_test}','getForTest');
        Route::post('/create/{id_test}', 'createForTest');
        Route::delete('/deleteone/{id_test}/{id_interpretation}', 'deleteForTestOne');
        Route::delete('/deleteall/{id_test}', 'deleteForTestAll');
        Route::put('/update/{id_interpretation}', 'update');
    });
});

Route::prefix('test')->group(function () {
    Route::controller(TestController::class)->group(function() {
        Route::get('/edit/{id_test}', 'edit')->name('edit')->middleware('auth');
        Route::get('/render', 'render')->name('home')->middleware('auth');
        Route::get('/add', 'addTest')->name('addTest')->middleware('auth');
        Route::post('/create', 'create')->name('create')->middleware('auth');
        Route::put('/update/{id_test}', 'update');
        Route::delete('/delete/{id_test}', 'delete');
    });
});

Route::prefix('question')->group( function () {
    Route::controller(QuestionController::class)->group(function() {
        Route::get('/get/{id_test}', 'getForTest')->name('getForTest')->middleware('auth');
        Route::get('/add/{id_test}', 'addQuestion')->name('addQuestion')->middleware('auth');
        Route::post('/create/{id_test}', 'createForTest')->name('createForTest')->middleware('auth');
        Route::put('/update/{id_question}', 'update');
        Route::get('/delete/{id_question}', 'delete')->name('deleteQuestion')->middleware('auth');
    });
});

Route::prefix('answer')->group(function () {
    Route::controller(AnswerController::class)->group(function() {
        Route::get('get/{id_question}', 'getForQuestion');
        Route::get('/add/{id_question}', 'addAnswer')->name('addAnswer')->middleware('auth');
        Route::post('create/{id_question}', 'createForQuestion')->name('createForQuestion');
        Route::put('update/{id_answer}', 'update');
        Route::delete('delete/{id_answer}', 'delete');
    });
});



// Route::controller(InterpretationController::class)->group(function() {

// });


// Route::controller(ResultController::class)->group(function() {

// });

// Route::controller(TestController::class)->group(function() {

// });

// Route::controller(UserController::class)->group(function() {

// });


