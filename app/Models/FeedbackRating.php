<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackRating extends Model
{
    use HasFactory;

    // Define the table name, if it doesn’t match the default convention
    protected $table = 'feedback_ratings';

    // Specify the fillable columns to allow mass assignment
    protected $fillable = ['events_id', 'users_id', 'rating', 'feedback_text'];

    // Relationships
    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    // FeedbackRating.php
    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }
}
