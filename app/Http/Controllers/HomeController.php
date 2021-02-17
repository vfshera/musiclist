<?php

namespace App\Http\Controllers;

use App\Beat;
use App\Drumkit;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function stats()
    {
        $beats = Beat::all()->count();
        $kits = Drumkit::all()->count();

        $stats = [
            'beats' => $beats,
            'kits' => $kits,
        ];

        return response()->json($stats , 200);
    }
}
