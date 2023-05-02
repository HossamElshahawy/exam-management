<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'date',
        'time',
        'mark',
        'attempt',
        'subject_id',
        'enterance_id'
    ];

    protected $appends = ['attempt_counter'];
    public $count = 0;
    public function subject()
        {
            return $this->belongsTo(Subject::class);
        }
    public function getQnaExam()
    {
        return $this->hasMany(QnaExam::class,'exam_id','id');
    }

    public function getIdAttribute($value)
    {
        $attemptCount = ExamAttempt::where(['exam_id'=>$value,'user_id'=>auth()->user()->id])->count();
        $this->count = $attemptCount;
        return $value;
    }

    public function getAttemptCounterAttribute()
    {
        return $this->count;
    }
}
