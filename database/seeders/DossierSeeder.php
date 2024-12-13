<?php

/** Seeder **/
use Illuminate\Database\Seeder;
use App\Models\Dossier;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DossierSeeder extends Seeder {
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        
        for ($i = 0; $i < 90; $i++) {
            $dateSignature = $faker->optional(0.8)->dateTimeBetween('-1 year', 'now');
            $dateCompletude = $dateSignature ? $faker->optional(0.7)->dateTimeBetween($dateSignature, 'now +6 months') : null;

            Dossier::create([
                'id_client' => $faker->numberBetween(1, 50),
                'id_caff' => $faker->numberBetween(1, 50),
                'localisation' => $faker->address,
                'superficie' => $faker->randomFloat(2, 50, 1000),
                'irradiance' => $faker->randomFloat(2, 100, 1000),
                'points_gps' => $faker->latitude . ',' . $faker->longitude,
                'raccordement' => $faker->randomFloat(2, 0.5, 10),
                'type' => $faker->randomElement(['Rénovation', 'Construction']),
                'type_construction' => $faker->optional()->word,
                'apporteur_affaire' => $faker->boolean,
                'puissance_estimee' => $faker->numberBetween(100, 300, 10),
                'status' => $faker->randomElement(['En cours', 'Abandonné', 'Etabli']),
                'date_signature' => $dateSignature ? $dateSignature->format('Y-m-d') : null,
                'date_completude' => $dateCompletude ? $dateCompletude->format('Y-m-d') : null,
            ]);
        }
    }
}