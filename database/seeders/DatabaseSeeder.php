<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(GradeSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(CaffSeeder::class);
        $this->call(DossierSeeder::class);
    }
}
