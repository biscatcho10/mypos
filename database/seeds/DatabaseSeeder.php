<?php

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
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategroyTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(ClientTableSeeder::class);
    }
}
