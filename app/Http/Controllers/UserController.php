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

    public function all(Request $request)
    {
        $users = User::when(isset($request->pattern), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->pattern . '%')
                ->orWhere('first_name', 'LIKE', '%' . $request->pattern . '%')
                ->orWhere('resume', 'LIKE', '%' . $request->pattern . '%');
        })
            ->when(isset($request->place), function ($query) use ($request) {
                $query->where('city', 'LIKE', '%' . $request->place . '%')
                    ->orWhere('city_department', 'LIKE', '%' . $request->place . '%');
            })
            ->when(isset($request->order), function ($query) use ($request) {
                $query->orderBy($request->order['by'], $request->order['type']);
            })
            ->when($request->has('lastexperience'), function ($query) {
                return $query->with('lastExperience');
            })
            ->when($request->has('lastformation'), function ($query) {
                return $query->with('lastFormation');
            })
            ->paginate(9);
        return response()->json($users);
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

    //CHECK SUGGESTION USERS
    public function suggestions(Request $request, Int $id)
    {

        $user = User::where('id', $id)->firstOrFail();

        $users = User::where('id', '!=', $id)
            ->where('id', '!=', Auth::id())
            ->where('city', $user->city)
            ->orWhere('city_department', $user->city_department)
            ->paginate(3);

        return response()->json($users);
    }
}
