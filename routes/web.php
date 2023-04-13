<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Professor\ProfessorController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Student\StudentController;
use App\Http\Controllers\Dashboard\Admin\FaculityController;
use App\Http\Controllers\Dashboard\Admin\DepartmentController;
use App\Http\Controllers\Dashboard\Admin\SubjectController;
use App\Http\Controllers\Dashboard\Professor\ChapterController;
use App\Http\Controllers\Dashboard\Admin\ApprovalController;


Route::middleware(['auth','web','user_approved'])->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::group(['middleware'=>['admin']],function(){

        Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');

        Route::resource('/admin/faculity', FaculityController::class);
        Route::resource('/admin/department', DepartmentController::class);
        Route::resource('/admin/subject', SubjectController::class);

        Route::get('/admin/users/approved', [ApprovalController::class,'approvedUsers'])->name('approved.index');
        Route::get('/admin/users/unapproved', [ApprovalController::class,'unapprovedUsers'])->name('unapproved.index');
        Route::post('/admin/users/{user}/approve', [ApprovalController::class,'approvedUser'])->name('approved');
        Route::delete('/admin/users/{prof}',[ApprovalController::class,'deleteProf'])->name('prof.destroy');

    


    });

    Route::group(['middleware'=>['professor']],function(){

        Route::get('/prof/dashboard', [ProfessorController::class,'index'])->name('professor.dashboard');

        Route::resource('/prof/chapter', ChapterController::class);

    });

    Route::group(['middleware'=>['student']],function(){

        Route::get('/student/dashboard', [StudentController::class,'index'])->name('student.dashboard');

    });
});



require __DIR__.'/auth.php';
