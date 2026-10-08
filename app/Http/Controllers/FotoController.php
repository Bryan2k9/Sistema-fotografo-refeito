<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Foto;
use Illuminate\Support\Facades\Auth;


class FotoController extends Controller
{
    public function store(Request $require) {

        $require->validate([
            'title' => ['string', 'max:280', 'required'],
            'photo' => ['image', 'required', 'max:2048', 'mimes:png,jpeg,jpg,webp'],
            'user_id' => ['integer'],
        ]);

        if($require->hasFile('photo')) {
            $path = $require->file('photo')->store('fotos-banco', 'public');
        }

        Foto::create([
            'title' => $require->title,
            'photo' => $path,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('dashboard');

    }
}
