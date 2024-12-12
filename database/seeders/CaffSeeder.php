<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Caff;
use Faker\Factory as Faker;

class CaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('fr_FR');;
        
        // Créer le Caff de grade 5
        $manager = Caff::create([
            'nom' => $faker->lastName,
            'prenom' => $faker->firstName,
            'ville' => $faker->city,
            'code_postal' => $faker->postcode,
            'email' => $faker->unique()->safeEmail,
            'telephone' => $faker->phoneNumber,
            'username' => $faker->unique()->userName,
            'password' => 'password', // Haché automatiquement
            'grade_id' => 5,
            'manager_id' => null, // Pas de manager au-dessus de lui
        ]);

        // Création de la hiérarchie descendante
        for ($grade = 4; $grade >= 1; $grade--) {
            $manager = Caff::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'ville' => $faker->city,
                'code_postal' => $faker->postcode,
                'email' => $faker->unique()->safeEmail,
                'telephone' => $faker->phoneNumber,
                'username' => $faker->unique()->userName,
                'password' => 'password',
                'grade_id' => $grade,
                'manager_id' => $manager->id,
            ]);
        }

        // Créer des Caffs supplémentaires
        foreach (range(1, 45) as $index) {
            $grade = rand(1, 4);
            $potentialManagers = Caff::where('grade_id', '=', $grade-1)->get();

            if ($potentialManagers->isNotEmpty()) {
                $assignedManager = $potentialManagers->random();

                Caff::create([
                    'nom' => $faker->lastName,
                    'prenom' => $faker->firstName,
                    'ville' => $faker->city,
                    'code_postal' => $faker->postcode,
                    'email' => $faker->unique()->safeEmail,
                    'telephone' => $faker->phoneNumber,
                    'username' => $faker->unique()->userName,
                    'password' => 'password',
                    'grade_id' => $grade,
                    'manager_id' => $assignedManager->id,
                ]);
            }
        }
    }
}
