<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cities = [
            ['name' => 'New York', 'country_code' => 'US'],
            ['name' => 'Los Angeles', 'country_code' => 'US'],
            ['name' => 'Toronto', 'country_code' => 'CA'],
            ['name' => 'Vancouver', 'country_code' => 'CA'],
            ['name' => 'London', 'country_code' => 'GB'],
            ['name' => 'Manchester', 'country_code' => 'GB'],
            ['name' => 'Sydney', 'country_code' => 'AU'],
            ['name' => 'Melbourne', 'country_code' => 'AU'],
            ['name' => 'Berlin', 'country_code' => 'DE'],
            ['name' => 'Munich', 'country_code' => 'DE'],
            ['name' => 'Frankfurt', 'country_code' => 'DE'],
            ['name' => 'Hamburg', 'country_code' => 'DE'],
            ['name' => 'Cologne', 'country_code' => 'DE'],
            // Add more cities as needed
        ];

        foreach ($cities as $city) {
            $country = Country::where('code', $city['country_code'])->first();
            if ($country) {
                City::updateOrCreate(['name' => $city['name'], 'country_id' => $country->id], [
                    'country_id' => $country->id,
                    'name' => $city['name']
                ]);
            }
        }
        //
      
    }
}
