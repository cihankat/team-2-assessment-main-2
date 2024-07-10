<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classrooms extends Model
{
    use HasFactory;

    protected $table = 'classrooms';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_classrooms', 'classroom_id', 'user_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'classroom_id');
    }
}
