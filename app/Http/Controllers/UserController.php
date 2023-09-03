<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addUser(Request $request)
    {

        $usersData = $request->all();

        foreach ($usersData as $u) {

            User::create([
                'name' => $u['name'],
                'mobile' => $u['mobile'],
                'email' => $u['email'],
                'country' => $u['country'],
                'state' => $u['state'],
                'city' => $u['city'],
                'password' => 'Admin@123',
            ]);
        }

        return response()->json('User created successfully');
    }
}
