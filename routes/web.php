<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\InterpretationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

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

Route::controller(AnswerController::class)->group(function() {
  
});

Route::controller(InterpretationController::class)->group(function() {

});

Route::controller(QuestionController::class)->group(function() {

});

Route::controller(ResultController::class)->group(function() {

});

Route::controller(TestController::class)->group(function() {

});

Route::controller(UserController::class)->group(function() {

});