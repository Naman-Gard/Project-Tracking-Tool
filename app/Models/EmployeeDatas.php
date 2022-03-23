<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDatas extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'employee_list';
    protected $fillable = ['id','employee_id',
    'name',
    'designation',
    'department',
    'email_id',
    'date_of_joining',
    'reporting_to'];
}
