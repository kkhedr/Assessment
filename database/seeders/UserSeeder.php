<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        \App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        \App\Models\User::factory(8)->create();
        
        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@bevatel.com',
            'password' => Hash::make('pa$$word'),
        ]);

        $user->assignRole('super-admin');

        $user = \App\Models\User::factory()->create([
            'name' => 'author',
            'email' => 'author@bevatel.com',
            'password' => Hash::make('pa$$word'),
        ]);
        $user->assignRole('author');
    }
}
