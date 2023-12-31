<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'gender',
        'image',
        'date_of_birth',
        'class',
        'department'
    ];

    public function classes() {
        return $this->hasOne(StudentClass::class);
    }
}
