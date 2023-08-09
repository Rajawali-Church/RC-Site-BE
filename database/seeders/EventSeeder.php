<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->insert([
            'id' => 1,
            'name' => 'Minggu 2 - Agustus',
            'description' => 'Ibadah Minggu 2 agustus',
            'date' => Carbon::parse('2023-08-06'),
            'type' => 'weekly',
            'note' => null,
            'created_by' => 1,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);
    }
}
