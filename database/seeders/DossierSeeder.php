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

            $status = 'Nouveau';
            if ($date_signature && !$date_completude) {
                $status = 'En cours';
            } elseif ($date_signature && $date_completude) {
                $status = 'Etabli';
            }


            Dossier::create([
                'id_client' => $faker->numberBetween(1, 50),
                'id_caff' => $faker->numberBetween(1, 50),
                'apporteur_affaire' => $faker->boolean,
                'puissance_estimee' => $faker->numberBetween(100, 300, 10),
                'status' => $status,
                'date_signature' => $dateSignature ? $dateSignature->format('Y-m-d') : null,
                'date_completude' => $dateCompletude ? $dateCompletude->format('Y-m-d') : null,
            ]);
        }
    }
}