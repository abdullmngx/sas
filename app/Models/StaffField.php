<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffField extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'field_id',
        'session_id'
    ];
}
