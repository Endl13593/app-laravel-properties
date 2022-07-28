<?php

namespace Database\Seeders;

use App\Models\Contrato\Contrato;
use App\Models\Propriedade\Propriedade;
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
        Propriedade::factory()->count(100)->create();

        for($i = 0; $i <= 20; $i++)
        {
            Contrato::factory()->create();
        }
    }
}
