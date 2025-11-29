<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'curriculum_subject_id',
        'teacher_id',
        'sub_teacher_id',
        'day',
        'start_time',
        'end_time'
    ];
}
