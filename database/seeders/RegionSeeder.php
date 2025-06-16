<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\County;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $county = County::where('name', 'Kiambu')->first();

        if ($county) {
            $regions = ['Githunguri', 'Kiambaa', 'Lari', 'Limuru', 'Kabete', 'Gatundu North', 'Gatundu South', 'Juja', 'Kikuyu', 'Thika Town', 'Ruiru', 'Kiambu Town'];

            foreach ($regions as $regionName) {
                Region::firstOrCreate([
                    'name' => $regionName,
                    'county_id' => $county->id,
                ]);
            }
        }

        // Repeat for other counties as needed
    }
}

