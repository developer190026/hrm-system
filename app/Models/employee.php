<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department; 

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'salary',
        'image'
    ];

    public function department()
    {
        return $this->belongsTo(department::class);
    }

    // Optional accessor for image
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/user.jpg');
    }


}
