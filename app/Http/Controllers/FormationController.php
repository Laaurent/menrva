<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    //STORE A NEW FORMATION
    public function store(Request $request)
    {

        //FORMAT INPUT DATE FOR STORE MONTH AND
        $request['start_date'] .= "-01";
        if ($request['end_date'])
            $request['end_date'] .= "-01";

        $formation = Formation::create($request->toArray());
        return $formation;
    }
    //DELETE A FORMATION
    public function destroy(Request $request)
    {
        $formation = Formation::destroy($request->id);
        return $formation;
    }
}
