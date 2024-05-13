<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class Reset extends Controller
{
    public function index()
    {
        return view('reset');
    }
}
