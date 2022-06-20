<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\noteOTP;
use App\Http\Controllers\TeacherApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teacher/{id}', [TeacherApiController::class, 'index']);//
Route::post('/teacher/{id}/profile/edit', [TeacherApiController::class, 'profileedit']);//
Route::get('/teacher/course/{id}', [TeacherApiController::class, 'course']);//
Route::get('/teacher/{id}/courses', [TeacherApiController::class, 'courses']);//
Route::get('/teacher/notice/anotices', [TeacherApiController::class, 'anotices']);//
Route::get('/teacher/course/notice/{id}', [TeacherApiController::class, 'coursenotice']);//
Route::post('/teacher/course/noticeadd', [TeacherApiController::class, 'noticeadd']);//
Route::post('/teacher/course/noticeedit/{id}', [TeacherApiController::class, 'noticeedit']);//
Route::get('/teacher/course/notes/{id}', [TeacherApiController::class, 'coursenote']);//
Route::post('/teacher/course/noteadd', [TeacherApiController::class, 'noteadd']);//
Route::post('/teacher/course/noticedel/{id}', [TeacherApiController::class, 'coursenoticedel']);//
Route::post('/teacher/course/notedel/{id}', [TeacherApiController::class, 'coursenotedel']);
Route::post('/teacher/login', [TeacherApiController::class, 'logincheck']);
Route::post('/teacher/registration', [TeacherApiController::class, 'registration']);


Route::get('/teacher/email/send', function(){
    Mail::to('info@laravel.io')->send(new noteOTP());
    //return new noteOTP();
});//