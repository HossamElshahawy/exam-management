<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProfessorController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\FaculityController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\ChapterController;


Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::group(['middleware'=>['web','admin']],function(){

        Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');

        Route::resource('/admin/faculity', FaculityController::class);
        Route::resource('/admin/department', DepartmentController::class);
        Route::resource('/admin/subject', SubjectController::class);


    });

    Route::group(['middleware'=>['web','professor']],function(){

        Route::get('/prof/dashboard', [ProfessorController::class,'index'])->name('professor.dashboard');

        Route::resource('/prof/chapter', ChapterController::class);

    });

    Route::group(['middleware'=>['web','student']],function(){

        Route::get('/student/dashboard', [StudentController::class,'index'])->name('student.dashboard');

    });
});



require __DIR__.'/auth.php';
