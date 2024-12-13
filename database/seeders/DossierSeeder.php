<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dossier;
use App\Models\Client;
use App\Models\Caff;
use Faker\Factory as Faker;

class DossierSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        // Récupérer les IDs valides des clients et des CAFF
        $clientIds = Client::pluck('id')->toArray();
        $caffIds = Caff::pluck('id')->toArray();

        if (empty($clientIds)) {
            $this->command->warn('La table "clients" est vide. Veuillez la remplir avant d’exécuter ce seeder.');
            return;
        }

        if (empty($caffIds)) {
            $this->command->warn('La table "caff" est vide. Veuillez la remplir avant d’exécuter ce seeder.');
            return;
        }

        for ($i = 0; $i < 90; $i++) {
            $dateSignature = $faker->optional(0.8)->dateTimeBetween('-1 year', 'now');
            $dateCompletude = $dateSignature ? $faker->optional(0.7)->dateTimeBetween($dateSignature, 'now +6 months') : null;

            $status = 'Abandonné';
            if ($dateSignature && !$dateCompletude) {
                $status = 'En cours';
            } elseif ($dateSignature && $dateCompletude) {
                $status = 'Etabli';
            }

            Dossier::create([
                'id_client' => $faker->randomElement($clientIds), // ID client valide
                'id_caff' => $faker->randomElement($caffIds), // ID CAFF valide
                'apporteur_affaire' => $faker->boolean,
                'puissance_estimee' => $faker->numberBetween(100, 300, 10),
                'status' => $status,
                'date_signature' => $dateSignature ? $dateSignature->format('Y-m-d') : null,
                'date_completude' => $dateCompletude ? $dateCompletude->format('Y-m-d') : null,
            ]);
        }
    }
}
