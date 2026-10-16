<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'title' => ['nullable', 'string', 'max:50'],
            'user_id' => ['integer'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
        }

        Photo::create([
            'title' => $request->title,
            'user_id' => $request->user()->id,
            'photo' => $path,
        ]);

        return redirect()->route('dashboard');

    }
}
