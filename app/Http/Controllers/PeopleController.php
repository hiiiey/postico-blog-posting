<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('people.index', compact('users'));
    }
}
