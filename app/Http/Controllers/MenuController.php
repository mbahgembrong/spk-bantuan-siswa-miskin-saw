<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    public function sideBar(Request $request)
    {
        $menus = Kriteria::all();
        return View::make('layouts.menu_kriteria', compact('menus'));
    }
}