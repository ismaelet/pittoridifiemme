<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtistController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        $artist = Artist::query()->with('images')->find($request->integer('id'));

        if ($artist === null || $artist->images->isEmpty()) {
            return redirect('/');
        }

        $images = $artist->images->values();
        $current = $images->firstWhere('ID', $request->integer('imgID')) ?? $images->first();

        $position = $images->search(fn ($image) => $image->is($current));
        $count = $images->count();

        return view('artist', [
            'artist' => $artist,
            'images' => $images,
            'current' => $current,
            'previous' => $images[($position - 1 + $count) % $count],
            'next' => $images[($position + 1) % $count],
            'position' => $position + 1,
            'count' => $count,
        ]);
    }
}
