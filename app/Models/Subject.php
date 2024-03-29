<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'level',
        'user_id',
        'department_id'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chapter()
    {
        return $this->hasMany(Chapter::class);
    }
    public function exam()
    {
        return $this->hasMany(Exam::class);
    }
}
