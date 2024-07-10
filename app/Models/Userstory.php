<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userstory extends Model
{
    use HasFactory;
     public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'userstories_users', 'userstory_id', 'user_id');
    }

    public function checklists_users()
    {
        return $this->belongsToMany(Checklist::class, 'userstories_users', 'userstory_id', 'checklist_id');
    }
}