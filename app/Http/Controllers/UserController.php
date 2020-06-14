<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me() {

        $user = Auth::user();

        return response()->json([
            'data' => [
                'success' => true,
                'message' => 'Here is the the user',
                'data' => $user,
            ]
        ]);
    }
}
