<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['assessment_id', 'title'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'checklists_users', 'checklist_id', 'user_id');
    }
    public function assessment()
    {
        return $this->belongsTo(Assessment::class , 'assessment_id' , 'id');
    }

    public function userstories()
    {
        return $this->hasMany(Userstory::class, 'checklist_id');
    }

    public function userstoriesUsers()
    {
        return $this->belongsToMany(Userstory::class, 'userstories_users', 'checklist_id', 'userstory_id');
    }
}