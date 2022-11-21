<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::get('/', function () {
    return view('form');
});

Route::get('/add-student', function(){
    return view('form');
});

Route::get('/get-student',function(){
    return view('student');
});

Route::post('/add-student',[StudentController::class,'addStudent'])->name('addStudent');
Route::get('/get-all-student',[StudentController::class,'getStudent'])->name('getStudent');
Route::get('/editStudent/{id}',[StudentController::class,'getStudentData']);
Route::post('/update-student',[StudentController::class,'updateStudent'])->name('updateStudent');
Route::get('/delete-data/{id}',[StudentController::class,'deleteData']);
