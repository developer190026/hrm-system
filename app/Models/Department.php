<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Department extends Model
{
    use HasFactory;

    // Tell Laravel to use the 'department' table (singular)
    protected $table = 'department';

    protected $fillable = [
        'department_name',
        'description',
    ];

    // Define the relationship: One Department has many Employees
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    
}
