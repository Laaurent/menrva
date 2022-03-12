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
        $user_id = Auth::id();
        return view('pages.user', compact('user_id'));
    }

    //READ USER INFORMATIONS BY ID
    public function read($id)
    {
        $user = User::where('id', $id)->with(['formations'])->first();

        return $user;
    }

    //UPDATE INFORMATIONS FROM PROFIL
    public function update(Request $request, $id)
    {
        $success = User::find($id)->update($request->form);

        return $success;
    }

    // CHECK IF THE USER IS LOG AND RETURN IT
    public function auth()
    {
        $user = Auth::user();

        return $user;
    }
}
