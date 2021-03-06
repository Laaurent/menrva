<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $likes = Like::when($request->has('user_id'), function ($query) use ($request) {
            return $query->where('user_id', $request->query('user_id'));
        })
            ->when($request->has('pending'), function ($query) use ($request) {
                return $query->where('playlist_id', null);
            })
            ->with('userLiked')
            ->get();

        return response()->json($likes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $like = Like::create([
            'user_id' => Auth::id(),
            'user_liked_id' => $request->user_id,
        ]);

        if ($like)
            return response()->json(['success' => 'Like ajouté avec succès']);
        abort(500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $like = Like::where('user_liked_id', $request->user_id)->where('user_id', Auth::id())->update([
            'playlist_id' => $request->playlist_id,
        ]);

        return response()->json(['success' => 'Playlist ajouté avec succès']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $like = Like::where('user_id', Auth::id())
            ->where('user_liked_id', $request->user_id)
            ->delete();

        if ($like)
            return response()->json(['success' => 'Like a été supprimé avec succès']);
        else
            abort(500);
    }
}
