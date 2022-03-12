<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    //STORE A NEW FORMATION
    public function store(Request $request)
    {
        $formation = Formation::create($request->toArray());
        return $formation;
    }
    //DELETE A FORMATION
    public function delete(Request $request)
    {
        $formation = Formation::destroy($request->id);
        return $formation;
    }
}
