<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!Admin::where('email', 'admin@mail.com')->exists()) {
            Admin::create([
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => '123456789@admin',
                'phone' => '0123456789',
                'is_active' => false,
                'image' => 'admin.jpg',
            ]);
        }

        if (!Admin::where('email', 'admin@admin.com')->exists()) {
            Admin::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '123456789',
                'phone' => '0123456789',
                'is_active' => true,
                'image' => 'admin.jpg',
            ]);
        }
    }
}
