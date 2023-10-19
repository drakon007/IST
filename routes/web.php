<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\InterpretationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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

// todo сделать авторизацию
Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login');
        Route::post('/create', 'createUser');
    });
});

Route::prefix('test')->group(function () {
    Route::controller(TestController::class)->group(function() {
        Route::get('render', 'render');
        Route::post('/create', 'create');
    });
});




// Route::controller(AnswerController::class)->group(function() {

// });

// Route::controller(InterpretationController::class)->group(function() {

// });

// Route::controller(QuestionController::class)->group(function() {

// });

// Route::controller(ResultController::class)->group(function() {

// });

// Route::controller(TestController::class)->group(function() {

// });

// Route::controller(UserController::class)->group(function() {

// });
