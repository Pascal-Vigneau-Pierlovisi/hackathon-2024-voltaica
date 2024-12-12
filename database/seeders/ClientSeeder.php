<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        // Insérer 50 clients directement via Eloquent
        for ($i = 0; $i < 50; $i++) {
            Client::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'date_naissance' => $faker->date('Y-m-d', '2000-01-01'),
                'adresse' => $faker->address,
                'siret' => $faker->numerify('##############'),  // SIRET aléatoire
                'email' => $faker->unique()->safeEmail,
                'telephone' => $faker->optional()->phoneNumber,
                'nom_entreprise' => $faker->company,
            ]);
        }
    }
}
