<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class CountryStateController extends Controller
{
    /**
     * Get all countries
     *
     * @return response()
     */
    public function country()
    {
        $country = Country::get(['name', 'id']);

        return response()->json($country);
    }

    /**
     * Get states for country
     *
     * @return response()
     */
    public function state(Request $request)
    {

        $states = State::where('country_id', $request->country_id)
            ->get(['name', 'id']);

        return response()->json($states);
    }

    /**
     * Get cities for state
     * 
     * @return response()
     */
    public function city(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)
            ->get(['name', 'id']);

        return response()->json($cities);
    }
}
