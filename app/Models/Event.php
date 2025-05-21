<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Add 'start' and 'end' to the fillable property
    protected $fillable = ['title', 'description', 'start', 'end']; 

    public function users()
{
    return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
}
}


