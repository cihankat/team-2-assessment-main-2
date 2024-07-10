<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description','classroom_id'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'assessments_users');
    }

    public function checklists()
    {
        return $this->hasMany(Checklist::class , 'assessment_id' , 'id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classrooms::class);
    }
}
