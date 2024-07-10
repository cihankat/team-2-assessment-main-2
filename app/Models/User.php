<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'firstname' => $row[0],
            'prefix' => $row[1],
            'lastname' => $row[2],
            'gender' => $row[3],
            'email' => $row[4],
            'usernumber' => $row[5],
            // You may need to add additional fields or logic depending on your CSV structure and requirements
        ]);
    }
}

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Inside your User model
    protected $fillable = ['firstname', 'prefix', 'lastname', 'gender', 'email', 'usernumber', 'role', 'password', 'profile_picture'];
    // or if you're using guarded make sure 'firstname' is not listed there
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function assessments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Assessment::class, 'assessments_users');
    }
    public function classrooms()
    {
        return $this->belongsToMany(Classrooms::class, 'users_classrooms', 'user_id', 'classroom_id');
    }

    public function notifications(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function userstories()
    {
        return $this->belongsToMany(Userstory::class, 'userstories_users', 'user_id', 'userstory_id');
    }

    public function completedUserstories()
    {
        return $this->hasMany(CompletedUserstory::class);
    }
}
