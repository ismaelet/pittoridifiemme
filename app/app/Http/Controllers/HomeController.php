<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $artists = Artist::query()
            ->whereHas('images')
            ->with('images')
            ->orderBy('lname')
            ->orderBy('date')
            ->get();

        return view('home', ['artists' => $artists]);
    }
}
