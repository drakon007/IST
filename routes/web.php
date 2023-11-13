<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\InterpretationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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
   });
});

Route::prefix('interpretation')->group(function () {
    Route::controller(InterpretationController::class)->group(function() {
        Route::get('/render', 'render');
        Route::get('/get/{id_test}','getForTest');
        Route::post('/create/{id_test}', 'createForTest');
        Route::delete('/deleteone/{id_test}/{id_interpretation}', 'deleteForTestOne');
        Route::delete('/deleteall/{id_test}', 'deleteForTestAll');
        Route::put('/update/{id_interpretation}', 'update');
    });
});

Route::prefix('test')->group(function () {
    Route::controller(TestController::class)->group(function() {
        Route::get('/render', 'render')->name('home');
        Route::post('/create', 'create');
        Route::put('/update/{id_test}', 'update');
        Route::delete('/delete/{id_test}', 'delete');
    });
});

Route::prefix('question')->group( function () {
    Route::controller(QuestionController::class)->group(function() {
        Route::get('/get/{id_test}', 'getForTest');
        Route::post('/create/{id_test}', 'createForTest');
        Route::put('/update/{id_question}', 'update');
        Route::delete('/delete/{id_question}', 'delete');
    });
});

Route::prefix('answer')->group(function () {
    Route::controller(AnswerController::class)->group(function() {
        Route::get('get/{id_question}', 'getForQuestion');
        Route::post('create/{id_question}', 'createForQuestion');
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


