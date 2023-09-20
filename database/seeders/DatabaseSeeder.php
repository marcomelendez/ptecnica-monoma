<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'tester',
            'password' => Hash::make('PASSWORD'),
            'is_active'=>true,
            'last_login'=> $now = now(),
            'role'=>'manager'
        ]);

        \App\Models\User::factory(5)->create();
        \App\Models\Candidate::factory(3)->create();
    }
}
