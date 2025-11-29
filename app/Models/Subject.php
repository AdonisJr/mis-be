<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'grade_level_id',
        'program_id',
        'category',
        'units',
        'name',
        'code',
        'description',
        'status',
    ];
}
