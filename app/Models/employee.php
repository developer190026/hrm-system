<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use Illuminate\Notifications\Notifiable;

class Employee extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name',
        'department_id',
        'email',
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
