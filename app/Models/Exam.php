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
        'level',
        'attempt',
        'subject_id',
        'enterance_id'
    ];
    public function subject()
        {
            return $this->belongsTo(Subject::class);
        }
    public function getQnaExam()
    {
        return $this->hasMany(QnaExam::class,'exam_id','id');
    }
}
