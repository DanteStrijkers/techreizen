<?php
// filepath: [CreateReizenSeeder.php](http://_vscodecontentref_/0)
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reis;

class CreateReizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reizen = [
            [
                'naam' => 'Spanje',
                'contactemail' => 'techreizen@gmail.com',
            ],
            [
                'naam' => 'Zwitserland',
                'contactemail' => 'techreizen@gmail.com',
            ],
            [
                'naam' => 'Frankrijk',
                'contactemail' => 'techreizen@gmail.com',
            ],
        ];

        foreach ($reizen as $reis) {
            Reis::create($reis);
        }
    }
}