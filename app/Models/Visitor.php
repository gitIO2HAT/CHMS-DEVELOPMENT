<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    // Ensure to specify the table name if it's different from the plural form of the model name.
    //protected $table = 'visitors';

    // Define which fields are mass assignable to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'first_name',
        'last_name',
        'suffix',
        'birth_date',
        'gender',
        'age',
        'age_group',
        'address',
        'invitation_source',
        'phone_number',
        'interests',
        'email',
        'contact_preference',
        'interaction_history',
    ];

    // If you have a custom primary key, define it here
    // protected $primaryKey = 'visitor_id'; // Uncomment and adjust if necessary

    // If you're storing birth_date as a date field
    protected $casts = [
        'birth_date' => 'date',
    ];

    // Optional: Handle timestamps automatically if your table has `created_at` and `updated_at` columns
    public $timestamps = true; // Set this to false if you don't have timestamps in your table

    // You can also add additional validation rules or business logic in this model as needed

    // In Visitor.php model
    public function user()
     {
    return $this->belongsTo(User::class);
     }

}
