<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function get(){
        return response()->json(User::get());
    }

}
