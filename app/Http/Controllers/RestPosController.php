<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RestPosController extends Controller
{
    public function index()
    {
        return view('restaurant.menu');
    }
}
