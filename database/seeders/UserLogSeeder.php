<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UserLogSeeder extends Seeder
{
    public function run()
    {
        DB::table('user_logs')->insert([
            [
                'users_id' => 3, // Replace with a valid user ID
                'action' => 'Logged in',
                'ip_address' => '192.168.1.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_ids' => 5,
                'action' => 'Logged out',
                'ip_address' => '192.168.1.2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
