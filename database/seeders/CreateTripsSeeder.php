<?php
// filepath: [CreateReizenSeeder.php](http://_vscodecontentref_/0)
namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Seeder;

class CreateTripsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trips = [
            [
                'name' => 'Spanje',
                'contact-email' => 'techreizen@gmail.com',
            ],
            [
                'name' => 'Zwitserland',
                'contact-email' => 'techreizen@gmail.com',
            ],
            [
                'name' => 'Frankrijk',
                'contact-email' => 'techreizen@gmail.com',
            ],
        ];

        foreach ($trips as $trip) {
            Trip::create($trip);
        }
    }
}