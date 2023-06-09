<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'session_id',
        'topic',
        'abstract',
        'status'
    ];
}
