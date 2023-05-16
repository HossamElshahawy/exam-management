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
use App\Http\Controllers\Dashboard\professor\ExamController;
use App\Http\Controllers\Dashboard\professor\QnAController;
use App\Http\Controllers\Dashboard\Student\TestController;
use App\Http\Controllers\Dashboard\Professor\MarkController;
use App\Http\Controllers\Dashboard\Student\ResultController;
Route::middleware(['auth','web','user_approved'])->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::group(['middleware'=>['admin']],function(){

        Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');
        //branches
        Route::resource('/admin/faculity', FaculityController::class);
        Route::resource('/admin/department', DepartmentController::class);
        Route::resource('/admin/subject', SubjectController::class);
        // approved prof
        Route::get('/admin/users/approved', [ApprovalController::class,'approvedUsers'])->name('approved.index');
        Route::get('/admin/users/unapproved', [ApprovalController::class,'unapprovedUsers'])->name('unapproved.index');
        Route::post('/admin/users/{user}/approve', [ApprovalController::class,'approvedUser'])->name('approved');
        Route::delete('/admin/users/{prof}',[ApprovalController::class,'deleteProf'])->name('prof.destroy');



    });

    Route::group(['middleware'=>['professor']],function(){

        Route::get('/prof/dashboard', [ProfessorController::class,'index'])->name('professor.dashboard');

        Route::resource('/prof/chapter', ChapterController::class);
        Route::resource('/prof/exam', ExamController::class);

        Route::get('/prof/exams/get-questions', [ExamController::class,'getQuestions'])->name('getQuestions');
        Route::POST('/prof/exams/add-questions', [ExamController::class,'addQuestions'])->name('addQuestions');
        Route::get('/prof/exams/show-questions', [ExamController::class,'showExamQuestions'])->name('showExamQuestions');
        Route::get('/prof/exams/delete-questions', [ExamController::class,'deleteExamQuestions'])->name('deleteExamQuestions');

        //Q&A
        Route::resource('/prof/QnA', QnAController::class);
        Route::POST('/prof/QnA/delete', [QnAController::class,'deleteQnA'])->name('Qna.delete');

        //marks for each exam
        Route::get('prof/exams/mark',[MarkController::class,'index'])->name('mark.index');
        Route::PUT('prof/exams/mark',[MarkController::class,'update'])->name('mark.update');

        //marks students
        Route::get('prof/exams/student/mark',[MarkController::class,'studentMark'])->name('studentsMark');

    });

    Route::group(['middleware'=>['student']],function(){

        Route::get('/student/dashboard', [StudentController::class,'index'])->name('student.dashboard');

        Route::get('/student/tests', [TestController::class,'index'])->name('test.index');
        Route::get('/exam/{id}', [TestController::class,'loadExamDashobard'])->name('student.test');
        Route::POST('/exam/submit', [TestController::class,'examSubmit'])->name('student.examSubmit');
        Route::get('/student/result', [ResultController::class,'index'])->name('student.result');
        Route::get('/student/reviewQnA', [ResultController::class,'getReviewQnA'])->name('student.reviewQnN');


    });
});



require __DIR__.'/auth.php';
