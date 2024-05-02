<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
        return User::getUsers();
    }

    public function store(Request $request)
    {
        return User::storeUser($request);
    }
}
