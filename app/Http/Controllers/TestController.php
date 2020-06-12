<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TestPostControllerRequest;

class TestController extends Controller
{
    public function helloworld()
    {
        $var1 = 'Timmy';
        $var2 = 'Saffron';

        return $var1 . " " . $var2;
    }

    public function helloWorldPost(TestPostControllerRequest $request)
    {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $age = $request->age;

        return $firstname . " " . $lastname . " " . $age;
    }
}
