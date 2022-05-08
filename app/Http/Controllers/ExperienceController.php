<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreExperienceRequest $request
     * @return void
     */
    public function store(StoreExperienceRequest $request)
    {

        //FORMAT INPUT DATE FOR STORE MONTH AND
        $request['start_date'] .= "-01";
        if ($request['end_date'])
            $request['end_date'] .= "-01";

        $formation = Experience::create($request->toArray());
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
        $formation = Experience::destroy($request->id);
        return $formation;
    }
}
