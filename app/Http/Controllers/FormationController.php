<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {

        //FORMAT INPUT DATE FOR STORE MONTH AND
        $request['start_date'] .= "-01";
        if ($request['end_date'])
            $request['end_date'] .= "-01";

        $formation = Formation::create($request->toArray());
        return $formation;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return void
     */
    public function destroy(Request $request)
    {
        $formation = Formation::destroy($request->id);
        return $formation;
    }
}
