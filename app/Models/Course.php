<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;   // PENTING

    protected $fillable = [
        'course_code',
        'name',
        'sks',
        'lecturer',
        'description',
        'category',
    ];
}