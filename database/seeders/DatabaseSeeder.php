<?php

namespace Database\Seeders;

use App\Models\Freelance;
use App\Models\FreelanceUser;
use App\Models\Job;
use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 10 user
        User::factory(1)->create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::factory(9)->create();

        // 10 admins
        Admin::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        Admin::factory(9)->create();

        // 5 categories
        Category::create([
            'name' => 'Web Development',
        ]);

        Category::create([
            'name' => 'Graphic Design',
        ]);

        Category::create([
            'name' => 'Content Writing',
        ]);

        Category::create([
            'name' => 'Digital Marketing',
        ]);

        Category::create([
            'name' => 'Mobile App Development',
        ]);

        // 40 jobs
        Freelance::factory(40)->create();

        // 40 contracts
        FreelanceUser::factory(40)->create();
    }
}
