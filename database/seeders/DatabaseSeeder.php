<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Category::factory(10)->create();
        // Item::factory(10)->create();
        User::create([
            'name'=>'Super Admin',
            'phone'=>'09445903748',
            'profile'=>'images/profiles/sa.png',
            'email'=>'superadmin@gmail.com',
            'password'=>Hash::make('123456789'),
            'role'=>'Super Admin',
        ]);

    }
}