<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TeacherController;
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

Route::get('/', [PagesController::class, 'index']);



Route::get('/teacher', [TeacherController::class, 'index'])->middleware('AuthTeacher')->name('teacher.index');
Route::get('/teacher/profile', [TeacherController::class, 'profile'])->middleware('AuthTeacher')->name('teacher.profile');
Route::get('/teacher/profile/edit', [TeacherController::class, 'profileedit'])->middleware('AuthTeacher')->name('teacher.profileedit');
Route::post('/teacher/profile/edit', [TeacherController::class, 'profileeditc'])->middleware('AuthTeacher')->name('teacher.profileeditc');
Route::get('/teacher/course/{id}', [TeacherController::class, 'course'])->middleware('AuthTeacher')->name('teacher.course');
Route::get('/teacher/courses', [TeacherController::class, 'courses'])->middleware('AuthTeacher')->name('teacher.courses');
Route::get('/teacher/anotices', [TeacherController::class, 'anotices'])->middleware('AuthTeacher')->name('teacher.anotices');
Route::get('/teacher/course/notice/{id}', [TeacherController::class, 'coursenotice'])->middleware('AuthTeacher')->name('teacher.coursenotice');
Route::get('/teacher/course/noticeadd/{id}', [TeacherController::class, 'coursenoticeadd'])->middleware('AuthTeacher')->name('teacher.coursenoticeadd');
Route::get('/teacher/course/noteadd/{id}', [TeacherController::class, 'coursenoteadd'])->middleware('AuthTeacher')->name('teacher.coursenoteadd');
Route::get('/teacher/course/noticedel/{id}', [TeacherController::class, 'coursenoticedel'])->middleware('AuthTeacher')->name('teacher.coursenoticedel');
Route::post('/teacher/course/noticeaddcheck', [TeacherController::class, 'noticeaddcheck'])->middleware('AuthTeacher')->name('teacher.noticeaddcheck');
Route::post('/teacher/course/noteaddcheck', [TeacherController::class, 'noteaddcheck'])->middleware('AuthTeacher')->name('teacher.noteaddcheck');
Route::get('/teacher/course/noticeedit/{id}', [TeacherController::class, 'noticeedit'])->middleware('AuthTeacher')->name('teacher.noticeedit');
Route::post('/teacher/course/noticeedit/{id}', [TeacherController::class, 'noticeeditc'])->middleware('AuthTeacher')->name('teacher.noticeeditc');
Route::get('/teacher/course/notes/{id}', [TeacherController::class, 'coursenote'])->middleware('AuthTeacher')->name('teacher.coursenote');
Route::get('/teacher/course/note/{id}', [TeacherController::class, 'coursenoteup'])->middleware('AuthTeacher')->name('teacher.coursenoteup');
Route::get('/teacher/course/notedown/{id}', [TeacherController::class, 'coursenotedown'])->middleware('AuthTeacher')->name('teacher.coursenotedown');
Route::get('/teacher/course/notedel/{id}', [TeacherController::class, 'coursenotedel'])->middleware('AuthTeacher')->name('teacher.coursenotedel');
Route::post('/teacher/course/note/{id}', [TeacherController::class, 'coursenoteupc'])->middleware('AuthTeacher')->name('teacher.coursenoteupc');
//Route::get('/teacher/course/note/{id}', [TeacherController::class, 'coursenote'])->middleware('AuthTeacher')->name('teacher.coursenoteadd');
Route::get('/teacher/course/student/{id}', [TeacherController::class, 'student'])->middleware('AuthTeacher')->name('teacher.student');
Route::get('/teacher/login', [TeacherController::class, 'login'])->middleware('LoggedTeacher')->name('teacher.login');
Route::post('/teacher/login', [TeacherController::class, 'logincheck'])->name('teacher.logincheck');
Route::get('/teacher/logout', [TeacherController::class, 'logout'])->name('teacher.logout');


