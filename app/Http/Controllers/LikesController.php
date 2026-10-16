<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Like;

class LikesController extends Controller
{
    public function store(Request $request, Photo $foto) {
        $like = Like::where('user_id', $request->user()->id)
        ->where('foto_id', $foto->id)
        ->first();

        if($like) {
            $like->delete();
        } else {
            Like::create([
                'user_id' => $request->user()->id,
                'foto_id' => $foto->id,
            ]);
        }

        return redirect()->route('dashboard');
    }
}
