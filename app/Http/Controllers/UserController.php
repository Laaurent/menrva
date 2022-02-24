<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    // RELATE TO PROFIL PAGE
    public function index()
    {
        $user = Auth::user();
        return view('pages.user', compact('user'));
    }

    public function read($id)
    {
        $user = User::find($id);

        return $user;
    }
}
