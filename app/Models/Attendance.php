<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public function GetEmployee()
    {
        return $this->hasOne(Employee::class,'id','employee_id');
    }
}
