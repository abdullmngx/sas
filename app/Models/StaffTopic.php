<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic',
        'abstract',
        'staff_id',
        'session_id',
        'student_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
}
