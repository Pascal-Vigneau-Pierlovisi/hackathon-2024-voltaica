<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        <?php

namespace Database\Seeders;

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
            ['id' => 1, 'libelle' => "Chargé d'affaire"],
            ['id' => 2, 'libelle' => 'Manager'],
            ['id' => 3, 'libelle' => 'Senior Manager'],
            ['id' => 4, 'libelle' => 'Executive Manager'],
            ['id' => 5, 'libelle' => 'Elite Manager'],
        ];

        foreach ($grades as $grade) {
            Grade::updateOrCreate(['id' => $grade['id']], $grade);
        }
    }
}