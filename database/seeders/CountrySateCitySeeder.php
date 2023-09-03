<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class CountrySateCitySeeder extends Seeder
{
    /**
     * Run the database seeds.

     *

     * @return void
     */
    public function run()
    {

        /*------------------------------------------

        --------------------------------------------

        US Country Data

        --------------------------------------------

        --------------------------------------------*/

        $country = Country::create(['name' => 'United State']);

        $state = State::create(['country_id' => $country->id, 'name' => 'Florida']);

        City::create(['state_id' => $state->id, 'name' => 'Miami']);

        City::create(['state_id' => $state->id, 'name' => 'Tampa']);

        /*------------------------------------------

        --------------------------------------------

        India Country Data

        --------------------------------------------

        --------------------------------------------*/

        $country = Country::create(['name' => 'India']);

        $gj = State::create(['country_id' => $country->id, 'name' => 'Gujarat']);
        City::create(['state_id' => $gj->id, 'name' => 'Rajkot']);
        City::create(['state_id' => $gj->id, 'name' => 'Surat']);

        $up = State::create(['country_id' => $country->id, 'name' => 'Utter Pradesh']);
        City::create(['state_id' => $gj->id, 'name' => 'Mathura']);
        City::create(['state_id' => $gj->id, 'name' => 'Aligarh']);
    }
}
