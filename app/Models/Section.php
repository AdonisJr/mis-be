<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'school_year_id',
        'curriculum_id',
        'program_id',
        'grade_level_id',
        'adviser',
        'name',
        'capacity',
        'description',
        'room',
    ];
}
