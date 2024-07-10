<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import the BelongsTo class

class Appointment extends Model
{
    protected $fillable = [
        'title',
        'start_time',
        'finish_time',
        'comments',
        'classroom_id',
        'teacher_id',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classrooms::class);
    }


    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
}