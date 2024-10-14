<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Party;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    public function run(): void
    {
        $parties = Party::all();
        Guest::factory()->count(200)->recycle($parties)->create();
    }
}
