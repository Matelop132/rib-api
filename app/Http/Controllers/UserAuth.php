<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAuth extends Controller
{
    function userLogin(Request $request)
    {
        Session::put('user', $request->input('user'));

        return view('operations');
    }
}
