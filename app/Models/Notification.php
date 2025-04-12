<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    
    protected $table = 'notifications'; // This matches your database table
    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'date_time',
        'message',
    ];
    
}
