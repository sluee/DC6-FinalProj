<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $managerPosition = Position::factory()->create([
            'name' => 'Manager',
            'rate' => 450.00,
        ]);

        User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Admin',
            'phone' => '09121244888',
            'address' => 'Sagbayan, Bohol',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),

        ]);

        $manager = User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Manager',
            'phone' => '09121244888',
            'address' => 'Sagbayan, Bohol',
            'email' => 'employee@test.com',
            'password' => bcrypt('password123'),

        ]);

        Employee::factory()->create([
            'pos_id' => $managerPosition->id,
            'user_id' => $manager->id,
        ]);


        $this->call([
            RoleandPermissionSeeder::class,
            // UserSeeder::class
        ]);
    }
}
