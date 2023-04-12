<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculity extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
    ];
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
