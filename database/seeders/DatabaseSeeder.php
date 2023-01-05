<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::create([
            'name' => 'Manuel Gomez',
            'email' => 'jmgc@virket.com',
            'password' => bcrypt('123456789')
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Invoice::factory(100)->create();
    }
}
