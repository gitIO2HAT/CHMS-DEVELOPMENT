<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $table = 'user_logs'; 

    protected $fillable = ['users_id', 'action', 'ip_address','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
