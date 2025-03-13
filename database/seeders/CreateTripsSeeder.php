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

        foreach ($trips as $trip) {
            Trip::create($trip);
        }
    }
}