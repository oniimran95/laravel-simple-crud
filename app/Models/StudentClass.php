<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 't_class_id', 'reg_no', 'roll_no', 'result', 'status'];

    public function tClass() {
        return $this->hasOne(TClass::class);
    }
}
