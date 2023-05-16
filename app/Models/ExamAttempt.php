<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ExamAttempt extends Model
{
    use HasFactory;
    public $table = "exam_attempts";
    protected $fillable =[
        'user_id',
        'exam_id',
        'marks'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
