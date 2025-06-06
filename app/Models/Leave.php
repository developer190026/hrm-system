<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Leave extends Model
{
    protected $fillable = ['user_id', 'start_date', 'end_date', 'reason', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
