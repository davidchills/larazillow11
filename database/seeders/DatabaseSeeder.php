<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'is_admin' => true
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'is_admin' => false
       ]);       

        \App\Models\Listing::factory(10)->create([
            'owner_id' => 1
        ]);
        \App\Models\Listing::factory(10)->create([
            'owner_id' => 2
        ]);        
    }
}
