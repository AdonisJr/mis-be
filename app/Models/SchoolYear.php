<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    protected $casts = [
        'active' => 'boolean', // <-- this makes 'active' return true/false
    ];

    protected $fillable = ['name', 'start_date', 'end_date', 'active'];
}
