<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'full_name' => 'Bakuretsu Magic',
                'username' => 'bakuretsu',
                'password' => Hash::make('doomhammer', ['rounds' => '12']),
                'role_id' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
        ]);
    }
}
