<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $areas = [
            ['name' => 'Downtown', 'city_name' => 'New York'],
            ['name' => 'Brooklyn', 'city_name' => 'New York'],
            ['name' => 'Hollywood', 'city_name' => 'Los Angeles'],
            ['name' => 'Vancouver West', 'city_name' => 'Vancouver'],
            ['name' => 'Central London', 'city_name' => 'London'],
            ['name' => 'North Manchester', 'city_name' => 'Manchester'],
            ['name' => 'Bondi Beach', 'city_name' => 'Sydney'],
            ['name' => 'South Yarra', 'city_name' => 'Melbourne'],
            ['name' => 'Mitte', 'city_name' => 'Berlin'],
            ['name' => 'Charlottenburg', 'city_name' => 'Berlin'],
            ['name' => 'Maxvorstadt', 'city_name' => 'Munich'],
            ['name' => 'Altstadt-Lehel', 'city_name' => 'Munich'],
            ['name' => 'Innenstadt', 'city_name' => 'Frankfurt'],
            ['name' => 'Sachsenhausen', 'city_name' => 'Frankfurt'],
            ['name' => 'St. Pauli', 'city_name' => 'Hamburg'],
            ['name' => 'HafenCity', 'city_name' => 'Hamburg'],
            ['name' => 'Altstadt', 'city_name' => 'Cologne'],
            ['name' => 'Ehrenfeld', 'city_name' => 'Cologne'],
            // Add more areas as needed
        ];

        foreach ($areas as $area) {
            $city = City::where('name', $area['city_name'])->first();
            if ($city) {
                Area::updateOrCreate(['name' => $area['name'], 'city_id' => $city->id], [
                    'city_id' => $city->id,
                    'name' => $area['name']
                ]);
            }
        }
       
    }
}
