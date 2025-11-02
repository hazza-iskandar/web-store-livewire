<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => true
        ]);
        User::factory()->create([
            'username' => 'dummy',
            'email' => 'dummy@gmail.com',
            'password' => Hash::make('password')
        ]);
        
        // Category::factory(3)->create();
        // Product::factory(100)->create();
        // Banner::factory(8)->create();
    }
}
