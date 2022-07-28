<?php

namespace Database\Seeders;

use App\Models\Contrato\Contrato;
use App\Models\Propriedade\Propriedade;
use App\Models\User;
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

        for ($i = 0; $i <= 20; $i++) {
            Contrato::factory()->create();
        }

        User::updateOrCreate(
            ['email' => 'teste@example.com'],
            [
                'name' => 'Usuário de Teste',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );
    }
}
