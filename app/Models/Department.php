<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'faculity_id',
    ];

        public function faculity()
        {
            return $this->belongsTo(Faculity::class, 'faculity_id');
        }
        public function subject()
        {
            return $this->hasMany(Subject::class);
        }
        public function user()
        {
            return $this->hasMany(User::class);
        }

}
