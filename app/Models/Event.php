<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'date', 
        'location', 
        'category', 
        'description', 
        'image'
    ]; // Ensure consistency with your database columns

    // Cast the 'date' attribute to a Carbon instance
    protected $casts = [
        'date' => 'datetime', // Automatically cast to a Carbon instance
    ];

    // Accessor for the image URL
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image); // Assuming images are stored in public/storage
    }

    // Relationship with feedback ratings
    public function feedbackRatings()
    {
        return $this->hasMany(FeedbackRating::class, 'events_id');
    }

    // Example of a method to get the average rating
    public function averageRating()
    {
        return $this->feedbackRatings->avg('rating'); // Get average rating for the event
    }

    // Relationship with users (optional, based on your use case)
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class, 'events_id'); // Correct foreign key
    }

    public function participants()
    {
        return $this->hasMany(Participation::class, 'events_id')->where('status', 'approved'); // Correct foreign key
    }



}

