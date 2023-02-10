<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        return view('home');
    }
}
