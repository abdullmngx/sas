<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'staff_id',
        'session_id'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
