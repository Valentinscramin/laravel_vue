<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\SecretSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create(['password' => Hash::make('foo')]);
        \App\Models\Secret::factory(1)->create(['user_id' => 1, 'secret' => Hash::make('foo')]);
    }
}
