<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@advbox.com.br',
            'password' => 'admin@advbox.com.br',
        ]);

        if(App::isLocal()){
            $this->call([
                PartySeeder::class,
                GuestSeeder::class,
            ]);
        }
    }
}
