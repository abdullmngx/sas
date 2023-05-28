<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'matric_number',
        'field_id',
        'email',
        'password',
        'level_id',
        'programme_id',
        'department_id',
        'faculty_id'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn ($value, $attributes) => ucwords("{$attributes['first_name']} {$attributes['middle_name']} {$attributes['surname']}"));
    }
 
    public function matricNumber(): Attribute
    {
        return Attribute::make(get: fn($value) => strtoupper($value));
    }

    public function field(): Attribute
    {
       return Attribute::make(get:fn($value, $attributes)=> Fields::find($attributes['field_id'])?->name);
    }

    public function programme(): Attribute
    {
       return Attribute::make(get:fn($value, $attributes)=> Programme::find($attributes['programme_id'])?->name);
    }

    public function department(): Attribute
    {
       return Attribute::make(get:fn($value, $attributes)=> Department::find($attributes['department_id'])?->name);
    }

    public function faculty(): Attribute
    {
       return Attribute::make(get:fn($value, $attributes)=> Faculty::find($attributes['faculty_id'])?->name);
    }
    
    public function level(): Attribute
    {
       return Attribute::make(get:fn($value, $attributes)=> Level::find($attributes['level_id'])?->name);
    }

    public function isAssigned(): Attribute
    {
        $current_session = Configuration::where('name', 'current_session')->first();
        return Attribute::make(get:fn ($value, $attributes) => SupervisorAssignment::where('student_id', $attributes['id'])->where('session_id', $current_session->value)->exists());
    }

    public function assignment(): Attribute
    {
        $current_session = Configuration::where('name', 'current_session')->first();
        return Attribute::make(get: fn($value, $attributes) => SupervisorAssignment::where('student_id', $attributes['id'])->where('session_id', $current_session->value)->first());
    }

    public function topic(): Attribute
    {
        $current_session = Configuration::where('name', 'current_session')->first();
        return Attribute::make(get: function ($value, $attributes) use ($current_session) {
            $fromStaff = StaffTopic::where('student_id', $attributes['id'])->where('session_id', $current_session->value)->first(); 
            if (!is_null($fromStaff))
            {
                return $fromStaff;
            }
            else
            {
                return StudentTopic::where('student_id', $attributes['id'])->where('session_id', $current_session->value)->where('status', 'approved')->first();
            }
        });
    }

    public function topics(): HasMany
    {
        return $this->hasMany(StudentTopic::class);
    }

    public function pendingTopics(): Attribute
    {
        return Attribute::make(get: fn($val, $att) => StudentTopic::where('student_id', $att['id'])->where('status', 'pending')->count());
    }
}
