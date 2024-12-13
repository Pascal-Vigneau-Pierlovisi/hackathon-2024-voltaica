<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            ['id' => 1, 'libelle' => "Chargé d'affaire", 'quota' => 0],
            ['id' => 2, 'libelle' => 'Manager', 'quota' => 3000],
            ['id' => 3, 'libelle' => 'Senior Manager', 'quota' => 2500],
            ['id' => 4, 'libelle' => 'Executive Manager', 'quota' => 1500],
            ['id' => 5, 'libelle' => 'Elite Manager', 'quota' => 1000],
        ];

        foreach ($grades as $grade) {
            Grade::updateOrCreate(['id' => $grade['id']], $grade);
        }
    }
}