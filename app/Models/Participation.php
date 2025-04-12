<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    use HasFactory;

    // Define the table name (optional if the table name is not plural)
    protected $table = 'participations';

    // Allow mass assignment for the following attributes
    protected $fillable = ['users_id', 'events_id', 'status'];

    // Define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

}

