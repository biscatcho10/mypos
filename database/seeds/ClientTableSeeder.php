<?php

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $clients = ['karim osama', 'ali mohamed', 'hossam zain', 'nour ezz'];

        foreach ($clients as $client) {

            Client::create([
               'name' => $client,
               'phone' => '010' . rand(10000000,99999999),
               'address' => $faker->address,
            ]);

        }//end of foreach
    }
}
