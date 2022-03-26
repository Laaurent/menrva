<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    // RELATE TO PROFIL PAGE
    public function index($id = null)
    {
        $user_id = $id == null && Auth::check() ?  Auth::id() : $id;
        return view('pages.user', compact('user_id'));
    }

    //READ USER INFORMATIONS BY ID
    public function read($id)
    {
        $user = User::where('id', $id)->with(['formations', 'experiences'])->firstOrFail();

        return $user;
    }

    //UPDATE INFORMATIONS FROM PROFIL
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if (isset($request->image) && $request->image != 'null') {
            $path = Storage::putFileAs(
                'public/avatars/' . Auth::id(),
                $data['image'],
                'avatar.png'
            );
            unset($data['image']);
        }
        if (isset($request->background) && $request->background != 'null') {
            $path = Storage::putFileAs(
                'public/avatars/' . Auth::id(),
                $data['background'],
                'background.png'
            );
            unset($data['background']);
        }


        $success = User::find($id)->update($data);

        return $success;
    }

    // CHECK IF THE USER IS LOG AND RETURN IT
    public function auth()
    {
        $user = Auth::user();

        return $user;
    }
}
