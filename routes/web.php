<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\InterpretationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerUserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
//    return view('welcome');

    return redirect()->route('home');
});

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/auth', 'auth')->name('auth');
        Route::post('/adduser', 'adduser')->name('adduser');
        Route::get('/create', 'create')->name('createUser');
        Route::get('/logout', 'logout')->name('logout');
    });
});

Route::prefix('interpretation')->group(function () {
    Route::controller(InterpretationController::class)->group(function () {
        Route::get('/render/{id_test}', 'render')->name('renderInter')->middleware('auth');
        Route::get('/get/{id_test}', 'getForTest')->name('getForTestInter')->middleware('auth');
        Route::get('/create/{id_test}', 'createPage')->name('createPageInter')->middleware('auth');
        Route::post('/create/{id_test}', 'createForTest')->name('createInterForTest')->middleware('auth');
        Route::get('/delete/{id_test}/{id_interpretation}', 'deleteForTestOne')->name('deleteInterForTest')->middleware('auth');
        Route::delete('/delete/{id_test}', 'deleteForTestAll');
        Route::put('/update/{id_interpretation}', 'update');
        Route::get('/results/{id_user}', 'getResults')->name('results')->middleware('auth');
    });
});

Route::prefix('test')->group(function () {
    Route::controller(TestController::class)->group(function () {
        Route::get('/start/{id_test}', 'startPage')->name('startTestPage')->middleware('auth');
        Route::get('/start/{id_test}/{id_user}', 'start')->name('startTest')->middleware('auth');
        Route::get('/edit/{id_test}', 'edit')->name('edit')->middleware('auth');
        Route::get('/render', 'render')->name('home')->middleware('auth');
        Route::get('/add', 'addTest')->name('addTest')->middleware('auth');
        Route::post('/create', 'create')->name('create')->middleware('auth');
        Route::get('/update/{id_test}', 'updatePage')->name('updatePageTest')->middleware('auth');
        Route::put('/update/{id_test}', 'update')->name('updateTest')->middleware('auth');
        Route::get('/delete/{id_test}', 'delete')->name('deleteTest')->middleware('auth');
    });
});

Route::prefix('question')->group(function () {
    Route::controller(QuestionController::class)->group(callback: function () {
        Route::get('/get/{id_test}', 'getForTest')->name('getForTest')->middleware('auth');
        Route::get('/add/{id_test}', 'addQuestion')->name('addQuestion')->middleware('auth');
        Route::post('/create/{id_test}', 'createForTest')->name('createForTest')->middleware('auth');
        Route::get('/update/{id_question}', 'updatePage')->name('updatePageQuestion')->middleware('auth');
        Route::put('/update/{id_question}', 'update')->name('updateQuestion')->middleware('auth');
        Route::get('/delete/{id_question}', 'delete')->name('deleteQuestion')->middleware('auth');
    });
});

Route::prefix('answer')->group(function () {
    Route::controller(AnswerController::class)->group(function () {
        Route::get('/get/{id_question}', 'getForQuestion'); // no use route
        Route::get('/add/{id_question}', 'addAnswer')->name('addAnswer')->middleware('auth');
        Route::post('/create/{id_question}', 'createForQuestion')->name('createForQuestion');
        Route::put('/update/{id_answer}', 'update'); // no use route
        Route::delete('/delete/{id_answer}', 'delete'); // no use route
    });
});

Route::prefix('useranswer')->group(function () {
    Route::controller(AnswerUserController::class)->group(function () {
        Route::post('create/{id_user}', 'saveAnswerUser')->name('saveAnswerUser')->middleware('auth');
    });
});





