<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            City::create([
                'name' => [
                    'ar' => 'القاهرة',
                    'en' => 'Cairo',
                ],
                'country_id' => $i,
            ]);
        }
    }
}
