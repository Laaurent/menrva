<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePlaylistRequest;
use App\Http\Requests\UpdatePlaylistRequest;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $playlists = Playlist::when($request->has('user_id'), function ($query) use ($request) {
            return $query->where('user_id', $request->query('user_id'));
        })
            ->with('likes.userLiked')->get();

        return response()->json($playlists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePlaylistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $playlist = Playlist::create([
            'user_id' => Auth::id(),
        ]);

        return response()->json($playlist);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePlaylistRequest  $request
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $playlist = Playlist::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return response()->json($playlist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $playlist = Playlist::findOrFail($id);

        if ($playlist->likes()->count() > 0)
            foreach ($playlist->likes as $like) {
                Like::where('id', $like->id)->update([
                    'playlist_id' => null,
                ]);
            }
        $playlist->delete();

        return response()->json($playlist);
    }
}
