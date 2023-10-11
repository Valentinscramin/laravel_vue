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
        \App\Models\Profiles::factory(3)->create();
        \App\Models\Categories::factory()->create();
        \App\Models\Products::factory(3)->create();
        \App\Models\User::factory(10)->create(['password' => Hash::make('foo')]);
    }
}
